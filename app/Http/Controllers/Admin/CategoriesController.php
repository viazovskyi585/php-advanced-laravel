<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\DeleteCategoryRequest;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::with('image')->orderByDesc('id')->paginate(8);

        return view('admin.categories.categories-index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.categories.categories-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, CategoryRepository $repository): RedirectResponse
    {
        return $repository->create($request) ?
            redirect()->route('admin.categories.index') :
            redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = Category::with('image')->findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get();

        return view('admin.categories.categories-edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category, CategoryRepository $repository): RedirectResponse
    {
        return $repository->update($category, $request) ?
            redirect()->route('admin.categories.index') :
            redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCategoryRequest $request, Category $category): RedirectResponse
    {
        if ($category->childs()->exists()) {
            $category->childs()->update(['parent_id' => null]);
        }

        $category->deleteOrFail();

        return redirect()->route('admin.categories.index');
    }
}
