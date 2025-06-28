<?php

namespace App\Http\Controllers;

use App\Models\CostumersModel;
use App\Models\FamilyGroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dataTable = CostumersModel::getDashboardData();

        return view('pages.dashboard.index', compact('dataTable'));
    }

    public function charts()
    {
        $addressData = CostumersModel::join('address', 'costumers.id', '=', 'address.costumer_id')
            ->select('address.neighborhood', DB::raw('count(*) as total'))
            ->groupBy('address.neighborhood')
            ->get();

        $ageData = FamilyGroupModel::select(DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE())'))
            ->get();

        return view('pages.dashboard.charts', compact('addressData', 'ageData'));
    }
}
