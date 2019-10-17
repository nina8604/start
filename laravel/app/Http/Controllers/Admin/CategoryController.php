<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CategoryDto;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\CategoryRequest;
use App\Services\PictureService;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     *
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

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
        return view('admin.categories.create', ['category' => new Category()]);
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(CategoryRequest $request)
    {
        $categoryDto = CategoryDto::createFromArray(array_merge($request->all(), [
            'file' => $request->file('file'),
        ]));

        $this->service->createCategory($categoryDto);

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
        return view('admin.categories.create', [
            'category' => $category,
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $categoryDto = CategoryDto::createFromArray(array_merge($request->all(), [
            'file' => $request->file('file'),
        ]));

        $this->service->updateCategory($category, $categoryDto);

        return redirect()->route('admin.categories.index');
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
