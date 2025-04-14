<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDatatable;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(CategoriesDatatable $dataTable)
    {
        $admin = Admin::find(Auth::id());

        if ($admin->isEmployee()) {
            return abort(403);
        }

        return $dataTable->render('pages.categories.index');
    }

    public function create(): View
    {
        $admin = Admin::find(Auth::id());

        if ($admin->isEmployee()) {
            return abort(403);
        }

        return view('pages.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category): View
    {
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully']);
    }
}
