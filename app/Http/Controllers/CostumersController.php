<?php

namespace App\Http\Controllers;

use App\Http\Utils\Response;
use App\Models\AddressModel;
use App\Models\RedeemsModel;
use Illuminate\Http\Request;
use App\Models\CostumersModel;
use App\Models\HabitationModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FamilyGroupModel;
use App\Models\ObservationsModel;
use Illuminate\Support\Facades\DB;
use App\Models\HealthSituationModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestInsertCosutumer;

class CostumersController extends Controller
{
    public function index(Request $request)
    {
        $query = CostumersModel::query();

        if ($request->has('cpf')) {
            $query->where('cpf', 'like', '%' . $request->cpf . '%');
        }

        return view('pages.costumers.index', ['costumers' => $query->paginate()]);
    }

    public function checkCpf(Request $request, $id = null)
    {
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $query = CostumersModel::where('cpf', $cpf);

        if ($id) {
            $query->where('id', '!=', $id);
        }

        $exists = $query->exists();
        return Response::success('CPF check', ['exists' => $exists]);
    }

    public function newRecord($id)
    {
        $admin = Auth::user();
        $costumer = CostumersModel::find($id);

        $personsData = [
            'admin' => $admin,
            'costumer' => $costumer,
        ];
        return view('pages.costumers.new-record', compact('personsData'));
    }

    public function view($id)
    {
        $admin = Auth::user();
        $costumer = CostumersModel::find($id);
        $address = AddressModel::where('costumer_id', $id)->first();
        $familyGroup = FamilyGroupModel::where('costumer_id', $id)->get();
        $habitation = HabitationModel::where('costumer_id', $id)->first();
        $healthSituation = HealthSituationModel::where('costumer_id', $id)->first();
        $observations = ObservationsModel::where('costumer_id', $id)->first();

        $reedeems = RedeemsModel::where('costumer_id', $id)->orderBy('created_at', 'desc')->get();

        $personsData = [
            'admin' => $admin,
            'costumer' => $costumer,
            'address' => $address,
            'familyGroup' => $familyGroup,
            'habitation' => $habitation,
            'healthSituation' => $healthSituation,
            'observations' => $observations,
            'reedeems' => $reedeems,
        ];

        return view('pages.costumers.view', compact('personsData'));
    }

    public function print($id)
    {
        $costumer = CostumersModel::find($id);
        $address = AddressModel::where('costumer_id', $id)->first();
        $familyGroup = FamilyGroupModel::where('costumer_id', $id)->get();
        $habitation = HabitationModel::where('costumer_id', $id)->first();
        $healthSituation = HealthSituationModel::where('costumer_id', $id)->first();
        $observations = ObservationsModel::where('costumer_id', $id)->first();

        $data = [
            'costumer' => $costumer,
            'address' => $address,
            'familyGroup' => $familyGroup,
            'habitation' => $habitation,
            'healthSituation' => $healthSituation,
            'observations' => $observations,
        ];

        return Pdf::loadView('pdfs.CostumerPdf', $data)->stream('costumer.pdf');
    }

    public function create()
    {
        return view('pages.costumers.form');
    }

    public function edit($id)
    {
        $costumer = CostumersModel::find($id);
        $address = AddressModel::where('costumer_id', $id)->first();
        $familyGroup = FamilyGroupModel::where('costumer_id', $id)->get();
        $habitation = HabitationModel::where('costumer_id', $id)->first();
        $healthSituation = HealthSituationModel::where('costumer_id', $id)->first();
        $observations = ObservationsModel::where('costumer_id', $id)->first();

        $data = [
            'costumer' => $costumer,
            'address' => $address,
            'familyGroup' => $familyGroup,
            'habitation' => $habitation,
            'healthSituation' => $healthSituation,
            'observations' => $observations,
        ];

        return view('pages.costumers.edit', compact('data'));
    }

    public static function insertRecord(Request $request, $id)
    {
        $requestData = $request->all();

        DB::beginTransaction();

        $createRedeem = RedeemsModel::create([
            'costumer_id' => $id,
            'responsible_id' => Auth::user()->id,
            'responsible_name' => Auth::user()->name,
            'observation' => $requestData['observation'] ?? null,
            'delivery_date' => $requestData['delivery_date'] ?? null,
        ]);

        $updateCostumer = CostumersModel::where('id', $id)->update([
            'last_redeem' => date('Y-m-d'),
        ]);

        if ($createRedeem && $updateCostumer) {
            DB::commit();
            return Response::success('Registro criado com sucesso!', $createRedeem);
        } else {
            DB::rollBack();
            return Response::error('Erro ao criar registro!', $createRedeem);
        }
    }

    public function insert(RequestInsertCosutumer $request)
    {
        $requestData = $request->all();

        DB::beginTransaction();

        $requestData['costumer']['cpf'] = preg_replace('/[^0-9]/', '', $requestData['costumer']['cpf']);
        $createCostumer = CostumersModel::create($requestData['costumer']);

        $requestData['address']['costumer_id'] = $createCostumer['id'];
        $createAddress = AddressModel::create($requestData['address']);

        foreach ($requestData['relatives'] as $person) {
            if (empty($person['name'])) {
                continue;
            }
            $person['costumer_id'] = $createCostumer['id'];
            FamilyGroupModel::create($person);
        }

        if (!empty($requestData['healthSituation']['vices']) || !empty($requestData['healthSituation']['chronic_diseases'])) {
            $requestData['healthSituation']['costumer_id'] = $createCostumer['id'];
            HealthSituationModel::create($requestData['healthSituation']);
        }

        $requestData['habitation']['costumer_id'] = $createCostumer['id'];
        HabitationModel::create($requestData['habitation']);

        if (!empty($requestData['observations']['observation'])) {
            $requestData['observations']['costumer_id'] = $createCostumer['id'];
            ObservationsModel::create($requestData['observations']);
        }

        DB::commit();
        return Response::success('Cliente criado com sucesso!', $createCostumer);
    }

    public function delete($id)
    {
        $costumer = CostumersModel::find($id);
        $costumer->delete();
        return Response::success('Cliente deletado com sucesso!', $costumer);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        DB::beginTransaction();

        $costumer = CostumersModel::findOrFail($id);
        $costumer->update($requestData['costumer']);

        if (!empty($requestData['address'])) {
            AddressModel::updateOrCreate(['costumer_id' => $id], $requestData['address']);
        }

        if (!empty($requestData['relatives'])) {
            FamilyGroupModel::where('costumer_id', $id)->delete();
            foreach ($requestData['relatives'] as $relativeData) {
                $relativeData['costumer_id'] = $id;
                FamilyGroupModel::create($relativeData);
            }
        }

        if (!empty($requestData['healthSituation'])) {
            HealthSituationModel::updateOrCreate(['costumer_id' => $id], $requestData['healthSituation']);
        }

        if (!empty($requestData['habitation'])) {
            HabitationModel::updateOrCreate(['costumer_id' => $id], $requestData['habitation']);
        }

        if (!empty($requestData['observations'])) {
            ObservationsModel::updateOrCreate(['costumer_id' => $id], $requestData['observations']);
        }

        DB::commit();

        return Response::success('Cliente atualizado com sucesso!', $costumer);
    }
}