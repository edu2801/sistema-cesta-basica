<?php

namespace App\Http\Controllers;

use App\Http\Utils\Response;
use App\Models\RedeemsModel;
use Illuminate\Http\Request;
use App\Models\CostumersModel;
use Illuminate\Support\Facades\DB;
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
    }
}
