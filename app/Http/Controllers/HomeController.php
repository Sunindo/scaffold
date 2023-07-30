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

        // var_dump($categories);
        // die();

        return view('layouts.master', compact('categories'));
    }
}