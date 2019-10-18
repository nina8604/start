<?php

namespace App\Http\Controllers\Admin;

use App\DTO\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    protected $service;

    /**
     * ProductsController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param Product $products
     * @return View
     */
    public function index(Request $request, Product $products):View
    {
        return view('admin.products.index', [
            'products' => $products->get(),
        ]);
    }

    /**
     * @return View
     */
    public function create():View
    {
        $categories = Category::all();
        $product = new Product();

        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(ProductRequest $request)
    {
        $productDto = ProductDto::createFromArray($request->all());

        $this->service->createProduct($productDto);

        return redirect()->route('admin.products.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product):View
    {
        $categories = Category::all();
        $category = $product->category;
        return view('admin.products.create', compact('product', 'categories', 'category') );
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productDto = ProductDto::createFromArray($request->all());

        $this->service->updateProduct($product, $productDto);

        return redirect()->route('admin.products.index');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');

    }

}
