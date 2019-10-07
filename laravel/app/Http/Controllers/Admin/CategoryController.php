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
        return view('admin.categories.create');
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

////        if($request->has('file')){
////            $file = $request->file('file');
////            $ext = $file->extension();
////            $fileName = uniqid(time(), true).".{$ext}";
//        $picture = new PictureService();
//        $file = $picture->getFile($request);
//            if($file->storeAs( Category::PICTURE_PATH, $picture->createFileName($file), ['disk' => 'public'])) {
////            if($file->storeAs( Category::PICTURE_PATH, $fileName, ['disk' => 'public'])) {
//                $category->create(array_merge($request->all(), [
//                    'file_name' => $picture->createFileName($file),
////                    'file_name' => $fileName,
//                ]));
//            }
////        }
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
//        return view('admin.categories.edit', [
        return view('admin.categories.create', [
            'categories' => $category,
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
