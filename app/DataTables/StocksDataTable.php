<?php

namespace App\DataTables;

use App\Enums\ProductStatusEnum;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StocksDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function (QueryBuilder $query) {
                if (request()->filled('filter.q')) {
                    $query->where(function ($query) {
                        $query->where('name', 'like', '%' . request('filter.q') . '%');
                    });
                }
                if (request()->filled('filter.status')) {
                    $query->where('status', request('filter.status'));
                }
            })
            ->editColumn('image', function ($query) {
                $url = $query->image_url;
                return "<a href='{$url}' target='_blank'>
<div class='' style='width: 35px;height: 35px'>
                        <img class='rounded-circle w-100 h-100' style='height: 100%;width: 100%;object-fit: fill' src=$url alt='$query->id'>
                        </div>
                        </a>";
            })
            ->addColumn('action', 'pages.products.action')
            ->editColumn('status', function ($query) {
                if ($query->status === "ACTIVE") {
                    return '<span class="badge bg-success">Active</span>';
                }
                if ($query->status === "INACTIVE") {
                    return '<span class="badge bg-danger">InActive</span>';
                }
                if ($query->status === "SOLD") {
                    return '<span class="badge bg-warning">Sold</span>';
                }
                if ($query->status === ProductStatusEnum::OUT_OF_STOCK->value) {
                    return '<span class="badge bg-danger">Out of stock</span>';
                }
                return '';
            })
            ->editColumn('actual_price', function (Product $product) {
                return number_format($product->actual_price);
            })
            ->editColumn('sold_price', function (Product $product) {
                return number_format($product->sold_price);
            })
            ->rawColumns(['action', 'status','image'])
            ->setRowId('id');
    }

    public function query(Product $model): QueryBuilder
    {
        return $model->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
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
            Column::make('quantity'),
            Column::make('sold_price')->title('Selling Price (AED)'),
            Column::make('image'),
            Column::make('status'),
        ];

        if (Admin::query()->findOrFail(Auth::id())->isSuperAdmin()) {
            $columns[] = Column::make('actual_price')->title('Actual Price');
        }

        $columns[] = Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center');

        return $columns;
    }


    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
