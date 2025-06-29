<?php

namespace App\Http\Controllers;

use App\Models\AddressModel;
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
        $neighborhoods = AddressModel::select('neighborhood', DB::raw('count(*) as total'))
            ->groupBy('neighborhood')
            ->pluck('total', 'neighborhood');

        $ages = CostumersModel::select(DB::raw('EXTRACT(YEAR FROM AGE(CURRENT_DATE, birth_date)) AS age'))
            ->get()
            ->groupBy(function ($item) {
                if ($item->age < 18) {
                    return '0-17';
                } elseif ($item->age >= 18 && $item->age <= 29) {
                    return '18-29';
                } elseif ($item->age >= 30 && $item->age <= 39) {
                    return '30-39';
                } elseif ($item->age >= 40 && $item->age <= 49) {
                    return '40-49';
                } else {
                    return '50+';
                }
            });

        $income = CostumersModel::select('family_income')
            ->get()
            ->groupBy(function ($item) {
                if ($item->family_income <= 500) {
                    return 'Até R$500';
                } elseif ($item->family_income > 500 && $item->family_income <= 1000) {
                    return 'R$501 - R$1000';
                } elseif ($item->family_income > 1000 && $item->family_income <= 2000) {
                    return 'R$1001 - R$2000';
                } else {
                    return 'Acima de R$2000';
                }
            })
            ->map(function ($group) {
                return $group->count();
            });

        return view('pages.dashboard.charts', compact('neighborhoods', 'ages', 'income'));
    }
}
