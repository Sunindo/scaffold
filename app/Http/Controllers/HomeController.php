<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $products = Products::select('parent_category.name as category_type', 'sub_category.name as category_name',
            'products.id', 'products.name', 'products.price', 'products.description')
            ->join('categories as sub_category', 'sub_category.id', '=', 'products.category_id')
            ->join('categories as parent_category', 'parent_category.id', '=', 'sub_category.parent_id')
            ->get()->toArray();

        return view('home.index', compact('categories', 'products'));
    }
}