<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseDatatable;
use App\Models\Admin;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(ExpenseDatatable $dataTable)
    {
        $admin = Admin::findOrFail(Auth::id());

        if (!$admin->isSuperAdmin()) {
            return abort(403);
        }

        return $dataTable->render('pages.expenses.index');
    }

    public function create(): View
    {
        $admin = Admin::findOrFail(Auth::id());

        if (!$admin->isSuperAdmin()) {
            return abort(403);
        }

        return view('pages.expenses.create');
    }

    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->category = $request->input('category');
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function show(Expense $expense): View
    {
        $admin = Admin::findOrFail(Auth::id());

        if (!$admin->isSuperAdmin()) {
            return abort(403);
        }

        return view('pages.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense): View
    {
        $admin = Admin::findOrFail(Auth::id());

        if (!$admin->isSuperAdmin()) {
            return abort(403);
        }

        return view('pages.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense):RedirectResponse
    {
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->category = $request->input('category');
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }
}
