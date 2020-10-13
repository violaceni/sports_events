<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function fetchAll()
    {
        $categories = Category::all();
        return datatables()->of($categories)->toJson();
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Category::validate($request);
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        } else { 
            $category = Category::create($data);
        }
        return redirect('/categories/index')->with(['message' => "New Category Added"]);

    }
}
