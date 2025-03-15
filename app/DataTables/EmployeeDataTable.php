<?php

namespace App\DataTables;

use App\Enums\Admin\AdminRoles;
use App\Enums\Users\UserStatusEnum;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function (QueryBuilder $query) {
                if (request()->filled('filter.q')) {
                    $query->where(function ($query) {
                        $query->where('name', 'like', '%' . request('filter.q') . '%');
                        $query->orWhere('mobile', 'like', '%' . request('filter.q') . '%');
                    });
                }
                if (request()->filled('filter.status')) {
                    $query->where(function ($query) {
                        $query->where('status', 'like', '%' . request('filter.status') . '%');
                    });
                }
            })
            ->editColumn('profile_image', function ($query) {
                $url = $query->profile_image_url;
                return "<a href='{$url}' target='_blank'>
            <div class='' style='width: 35px;height: 35px'>
                        <img class='rounded-circle w-100 h-100' style='height: 100%;width: 100%;object-fit: fill' src=$url alt='$query->id'>
                        </div></a>";
            })
            ->addColumn('mobile', function ($query) {
                return $query->mobile_country_code . " " . $query->mobile;
            })
            ->editColumn('status', function ($query) {
                if ($query->status === UserStatusEnum::Active->value) {
                    return '<span class="badge px-2 bg-label-success">Active</span>';
                }
                if ($query->status === UserStatusEnum::Blocked->value) {
                    return '<span class="badge px-2 bg-label-danger">Blocked</span>';
                }
                if ($query->status === UserStatusEnum::Deleted->value) {
                    return '<span class="badge px-2 bg-label-warning">Deleted</span>';
                }
                return null;
            })
            ->addColumn('action', 'pages.employees.action')
            ->rawColumns(['action', 'profile_image', 'status'])
            ->setRowId('id');
    }

    public function query(Admin $model): QueryBuilder
    {
        return $model->newQuery()->where('role', '!=', AdminRoles::SUPER_ADMIN->value)->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->searching(false)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('profile_image')
                ->title('Profile Image'),
            Column::make('name')
                ->title('Name'),
            Column::make('email')
                ->title('Email'),
            Column::make('mobile')
                ->title('Mobile Number'),
            Column::make('status')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
