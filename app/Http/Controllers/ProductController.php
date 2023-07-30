<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the product view.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // TODO: Create cache table to store category results in and remove the below section
        $parentCategories = Categories::select('id', 'name')->whereNull('parent_id')->get()->toArray();

        $categories = [];
        foreach($parentCategories as $parentCategory) {
            $childCategories = Categories::select('id', 'name')->where('parent_id', '=', $parentCategory['id'])->get()->toArray();
            foreach ($childCategories as $childCategory) {
                $products = Products::select('id', 'name')->where('category_id', '=', $childCategory['id'])->get()->toArray();
                foreach ($products as $product) {
                    $categories[$parentCategory['name']][$childCategory['name']][$product['id']] = $product['name'];
                }
            }
        }
        // TODO: Delete above section

        $product = Products::findOrFail($id);

        return view('products.index', compact('categories', 'product'));
    }
}