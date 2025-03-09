<?php

namespace App\Http\Controllers;

use App\DataTables\SoldStocksDataTable;

class SoldStockController extends Controller
{
    public function index(SoldStocksDataTable $dataTable)
    {
        return $dataTable->render('pages.sold-stocks.index');
    }
}
