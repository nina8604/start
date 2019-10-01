<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @param Category $categories
     * @return View
     */
    public function index(Request $request, Category $categories):View
    {
        return view('admin.categories.index', [
            'categories' => $categories->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $category->create($request->all());
        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category):View
    {
        return view('admin.categories.edit', [
            'categories' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return View
     */
    public function update(Request $request, Category $category):View
    {
        $category->update($request->all());
        return $this->edit($category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');

    }
}
