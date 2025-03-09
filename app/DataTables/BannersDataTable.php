<?php

namespace App\DataTables;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BannersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'pages.banners.action')
            ->editColumn('image', function ($query) {
                $url = $query->image_url;
                return '<img src=' . $url . ' class="rounded-circle" height="50" width="50">';
            })
            ->addColumn('status', function ($query) {
                if ($query->is_active == true) {
                    return '<span class="badge bg-success">Active</span>';
                }
                return '<span class="badge bg-danger">InActive</span>';
            })
            ->rawColumns(['action', 'image','status'])
            ->setRowId('id');
    }

    public function query(Banner $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('banners-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->searching(false)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('image'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Banners_' . date('YmdHis');
    }
}
