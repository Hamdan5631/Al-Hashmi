<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\Expense;
use App\Models\SoldProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpenseDatatable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function (QueryBuilder $query) {
                if (request()->filled('filter.q')) {
                    $search = request('filter.q');

                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                        $query->orWhere('description', 'like', '%' . $search . '%');
                        $query->orWhere('amount', 'like', '%' . $search . '%');
                    });
                }

            })
            ->editColumn('category', function ($query) {
                return Str::title($query->category);
            })
            ->editColumn('amount', function ($query) {
                return number_format($query->amount);
            })
            ->addColumn('action', 'pages.expenses.action')
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('expense-table')
            ->columns($this->getColumns())
            ->searching(false)
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Title'),
            Column::make('category'),
            Column::make('description'),
            Column::make('amount')->title('Amount (AED)'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    public function query(Expense $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
