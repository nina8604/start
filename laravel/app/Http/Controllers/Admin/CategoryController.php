<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\UploadedFile;

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
     * @return View
     */
    public function create():View
    {
        return view('admin.categories.create');
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Category $category)
    {
        if($request->has('file')){
            $file = $request->file('file');
            $ext = $file->extension();
            $fileName = uniqid(time(), true).".{$ext}";
            if($file->storeAs( Category::PICTURE_PATH, $fileName, ['disk' => 'public'])) {
                $category->create(array_merge($request->all(), [
                    'file_name' => $fileName,
                ]));
            }
        }
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
