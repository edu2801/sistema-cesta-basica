<?php

namespace App\Http\Controllers;

use App\Models\CostumersModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataTable = CostumersModel::getDashboardData();

        return view('pages.dashboard.index', compact('dataTable'));
    }
}
