<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInsertCosutumer;
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
use Laravel\Ui\Presets\React;

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

    public function create()
    {
        return view('pages.costumers.create');
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

        $createPerson = [true];
        foreach ($requestData['relatives'] as $person) {
            if (empty($person['name']) && empty($person['age'])  && empty($person['relationship'])) {
                continue;
            }
            $person['costumer_id'] = $createCostumer['id'];
            $createPerson[] = FamilyGroupModel::create($person);
        }

        $createHealth = true;
        if (!empty($requestData['healthSituation']['vices']) || !empty($requestData['healthSituation']['chronic_diseases'])) {
            $requestData['healthSituation']['costumer_id'] = $createCostumer['id'];
            $createHealth = HealthSituationModel::create($requestData['healthSituation']);
        }

        $requestData['habitation']['costumer_id'] = $createCostumer['id'];
        $createHabitation = HabitationModel::create($requestData['habitation']);

        $createObservation = true;
        if (!empty($requestData['observations']['observation'])) {
            $requestData['observations']['costumer_id'] = $createCostumer['id'];
            $createObservation = ObservationsModel::create($requestData['observations']);
        }

        if ($createCostumer && $createAddress && $createPerson && $createHealth && $createHabitation && $createObservation) {
            DB::commit();
            return Response::success('Cliente criado com sucesso!', $createCostumer);
        } else {
            DB::rollBack();
            return Response::error('Erro ao criar cliente!', $createCostumer);
        }
    }

    public function delete($id)
    {
        $costumer = CostumersModel::find($id);
        $costumer->delete();
        return Response::success('Cliente deletado com sucesso!', $costumer);
    }

    public function update(Request $request)
    {
        $requestData = $request->all();

        DB::beginTransaction();

        $updateCostumer = true;
        if (!empty($requestData['costumer'])) {
            $request->validate(
                [
                    'costumer.name' => 'required',
                    'costumer.cpf' => 'nullable|unique:costumers,cpf,' . $requestData['costumer']['id'],
                ],
                [
                    'costumer.name.required' => 'O campo nome é obrigatório',
                    'costumer.cpf.unique' => 'O CPF informado já está cadastrado',
                ]
            );
            $requestData['costumer']['cpf'] = preg_replace('/[^0-9]/', '', $requestData['costumer']['cpf']);
            unset($requestData['costumer']['created_at']);
            unset($requestData['costumer']['updated_at']);
            $updateCostumer = CostumersModel::where('id', $requestData['costumer']['id'])->update($requestData['costumer']);
        }

        $updateAddress = true;
        if (!empty($requestData['address'])) {
            unset($requestData['address']['created_at']);
            unset($requestData['address']['updated_at']);
            $updateAddress = AddressModel::where('costumer_id', $requestData['address']['costumer_id'])->update($requestData['address']);
        }

        $updatePerson = [true];
        if (!empty($requestData['relatives'])) {
            foreach ($requestData['relatives'] as $person) {
                if (empty($person['name']) && empty($person['age'])  && empty($person['relationship'])) {
                    continue;
                }
                unset($person['created_at']);
                unset($person['updated_at']);

                if (empty($person['id'])) {
                    $updatePerson[] = FamilyGroupModel::create($person);
                    continue;
                }

                $updatePerson[] = FamilyGroupModel::where('id', $person['id'])->update($person);
            }
        }

        $updateHealth = true;
        if (!empty($requestData['healthSituation'])) {
            unset($requestData['healthSituation']['created_at']);
            unset($requestData['healthSituation']['updated_at']);
            if (!empty($requestData['healthSituation']['vices']) || !empty($requestData['healthSituation']['chronic_diseases'])) {
                $updateHealth = HealthSituationModel::where('costumer_id', $requestData['healthSituation']['costumer_id'])->first();
                if (empty($updateHealth)) {
                    $updateHealth = HealthSituationModel::create($requestData['healthSituation']);
                } else {
                    $updateHealth = HealthSituationModel::where('costumer_id', $requestData['healthSituation']['costumer_id'])->update($requestData['healthSituation']);
                }
            }
        }

        $updateHabitation = true;
        if (!empty($requestData['habitation'])) {
            unset($requestData['habitation']['created_at']);
            unset($requestData['habitation']['updated_at']);
            $updateHabitation = HabitationModel::where('costumer_id', $requestData['habitation']['costumer_id'])->update($requestData['habitation']);
        }

        $updateObservation = true;
        if (!empty($requestData['observations'])) {
            unset($requestData['observations']['created_at']);
            unset($requestData['observations']['updated_at']);
            $updateObservation = ObservationsModel::where('costumer_id', $requestData['observations']['costumer_id'])->first();
            if (empty($updateObservation)) {
                $updateObservation = ObservationsModel::create($requestData['observations']);
            } else {
                $updateObservation = ObservationsModel::where('costumer_id', $requestData['observations']['costumer_id'])->update($requestData['observations']);
            }
        }

        if ($updateCostumer && $updateAddress && $updatePerson && $updateHealth && $updateHabitation && $updateObservation) {
            DB::commit();
            return Response::success('Cliente atualizado com sucesso!', $updateCostumer);
        } else {
            DB::rollBack();
            return Response::error('Erro ao atualizar cliente!', $updateCostumer);
        }
    }
}
