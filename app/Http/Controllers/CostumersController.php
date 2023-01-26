<?php

namespace App\Http\Controllers;

use App\Http\Utils\Response;
use App\Models\AddressModel;
use App\Models\RedeemsModel;
use Illuminate\Http\Request;
use App\Models\CostumersModel;
use App\Models\HabitationModel;
use App\Models\FamilyGroupModel;
use App\Models\ObservationsModel;
use Illuminate\Support\Facades\DB;
use App\Models\HealthSituationModel;
use Illuminate\Support\Facades\Auth;

class CostumersController extends Controller
{
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

        $personsData = [
            'admin' => $admin,
            'costumer' => $costumer,
            'address' => $address,
            'familyGroup' => $familyGroup,
            'habitation' => $habitation,
            'healthSituation' => $healthSituation,
            'observations' => $observations,
        ];

        return view('pages.costumers.view', compact('personsData'));
    }

    public function create()
    {
        return view('pages.costumers.create');
    }

    public static function insertRecord($id)
    {
        DB::beginTransaction();

        $createRedeem = RedeemsModel::create([
            'costumer_id' => $id,
            'responsible_id' => Auth::user()->id,
            'responsible_name' => Auth::user()->name,
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

    public function insert(Request $request)
    {
        $requestData = $request->all();

        DB::beginTransaction();
        $createCostumer = CostumersModel::create($requestData['costumer']);

        $requestData['address']['costumer_id'] = $createCostumer['id'];
        $createAddress = AddressModel::create($requestData['address']);

        $createPerson = [];
        foreach ($requestData['relatives'] as $person) {
            $person['costumer_id'] = $createCostumer['id'];
            $createPerson[] = FamilyGroupModel::create($person);
        }

        $requestData['healthSituation']['costumer_id'] = $createCostumer['id'];
        $createHealth = HealthSituationModel::create($requestData['healthSituation']);

        $requestData['habitation']['costumer_id'] = $createCostumer['id'];
        $createHabitation = HabitationModel::create($requestData['habitation']);

        $requestData['observations']['costumer_id'] = $createCostumer['id'];
        $createObservation = ObservationsModel::create($requestData['observations']);

        if ($createCostumer && $createAddress && $createPerson && $createHealth && $createHabitation && $createObservation) {
            DB::commit();
            return Response::success('Cliente criado com sucesso!', $createCostumer);
        } else {
            DB::rollBack();
            return Response::error('Erro ao criar cliente!', $createCostumer);
        }
    }
}
