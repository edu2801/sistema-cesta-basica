<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataTable = [];

        return view('pages.dashboard.index', compact('dataTable'));
    }
}
