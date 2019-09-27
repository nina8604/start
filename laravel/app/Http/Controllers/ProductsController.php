<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * @param Request $request
     * @param Product $product
     * @return View
     */
    public function index(Request $request, Product $product)
    {

    }
    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }
    /**
     * @return View
     */
    public function create()
    {
        //
    }
    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product)
    {
        //
    }
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * @param Product $product
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Product $product,Request $request)
    {
        //
    }
    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Product $product)
    {

    }
}
