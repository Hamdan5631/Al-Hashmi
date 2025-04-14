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
                    $search = request('filter.q');

                    $query->where(function ($query) use ($search) {
                        $query->where('selling_price', 'like', '%' . $search . '%')
                            ->orWhereHas('product', function ($q) use ($search) {
                                $q->where('name', 'like', '%' . $search . '%');
                            });
                    });
                }
                if (request()->filled('filter.employee')) {
                    $query->where(function ($query) {
                        $query->where('admin_id', request('filter.employee'));
                    });
                }
            })
            ->addColumn('name', function (SoldProduct $product) {
                return $product?->product?->name;
            })
            ->addColumn('sold_by', function (SoldProduct $product) {
                return '<a href="' . route('employees.show', $product->admin_id) . '">' . optional($product->employee)->name . '</a>';
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
            ->rawColumns(['action', 'status', 'sold_by', 'name'])
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
        $employeeId = $this->id;

        if ($employeeId) {
            return $model->where('admin_id', $employeeId);
        }

        return $model->latest();
    }

    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
