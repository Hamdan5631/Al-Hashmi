<?php

namespace App\Http\Controllers;

use App\DataTables\UserBiddingsDataTable;
use App\DataTables\UserOrdersDataTable;
use App\DataTables\EmployeeDataTable;
use App\Enums\Admin\AdminRoles;
use App\Enums\Users\UserStatusEnum;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmployeesController extends Controller
{
    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('pages.employees.index');
    }

    public function create(): View
    {
        return view('pages.employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->role = AdminRoles::EMPLOYEE;
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('mobile');
        $admin->mobile_country_code = '+971';
        $admin->password = Hash::make('al-hashmi@123');
        $admin->save();

        return redirect()->route('employees.index')->with('success', 'Employee has been created.');
    }

    public function destroy($id): JsonResponse
    {
        $user = Admin::findOrFail($id);

        if ($user->status === UserStatusEnum::Active->value) {
            $user->status = UserStatusEnum::Blocked;
            $user->save();
            return response()->json(['data' => 'User Blocked Successfully'], 200);
        }

        if ($user->status === UserStatusEnum::Blocked->value) {
            $user->status = UserStatusEnum::Active;
            $user->save();
            return response()->json(['data' => 'User Unblocked Successfully'], 200);
        }

        return response()->json(['error' => 'Invalid user status'], 400);
    }

}
