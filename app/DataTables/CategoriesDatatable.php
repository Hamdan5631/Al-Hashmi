<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDatatable extends DataTable
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
            })
            ->addColumn('action', 'pages.categories.action')
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->searching(false)
            ->minifiedAjax()
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];

    }

    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
