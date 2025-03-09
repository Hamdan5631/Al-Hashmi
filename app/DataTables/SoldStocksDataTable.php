<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\SoldProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SoldStocksDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function (QueryBuilder $query) {
                if (request()->filled('filter.q')) {
                    $query->where(function ($query) {
                        $query->whereHas('product', function ($query) {
                            $query->where('name', 'like', '%' . request('filter.q') . '%');
                        });
                    });
                }
            })
            ->addColumn('name', function (SoldProduct $product) {
                return $product?->product?->name;
            })
            ->addColumn('sold_by', function (SoldProduct $product) {
                return $product?->employee?->name;
            })
            ->addColumn('quantity', function (SoldProduct $product) {
                return $product?->quantity_sold;
            })
            ->editColumn('actual_price', function (SoldProduct $product) {
                return number_format($product->product?->actual_price);
            })
            ->editColumn('sold_price', function (SoldProduct $product) {
                return number_format($product->selling_price);
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('sold-stocks-table')
            ->columns($this->getColumns())
            ->searching(false)
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        $columns = [
            Column::make('name')->title('Product Name'),
            Column::make('sold_by')->title('Sold By'),
            Column::make('quantity')->title('Quantity Sold'),
            Column::make('sold_price')->title('Sold Price (AED)'),
        ];

        if (Admin::query()->findOrFail(Auth::id())->isSuperAdmin()) {
            $columns[] = Column::make('actual_price')->title('Actual Price (AED)');
        }

        return $columns;
    }

    public function query(SoldProduct $model): QueryBuilder
    {
        return $model->latest();
    }

    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
