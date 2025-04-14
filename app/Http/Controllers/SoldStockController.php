<?php

namespace App\Http\Controllers;

use App\DataTables\SoldStocksDataTable;
use App\Enums\Admin\AdminRoles;
use App\Models\Admin;

class SoldStockController extends Controller
{
    public function index(SoldStocksDataTable $dataTable)
    {
        $employees = Admin::query()->where('role', AdminRoles::EMPLOYEE->value)->get();

        return $dataTable->render('pages.sold-stocks.index', compact('employees'));
    }
}
