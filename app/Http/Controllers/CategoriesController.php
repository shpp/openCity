<?php

namespace App\Http\Controllers;

use Log;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function all()
    {
        $categories = Category::all();
        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        return view('categories.form', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, Category::$rules);
        $category = new Category();
        $category = $category->create([
            'name' => $request->name,
            'comment' => $request->comment
        ]);
        $message = 'Категорія ' . $category->name . ' створена!';
        Log::info(auth()->user()->email . ' створив категорію ' . $category->name);
        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'response' => 'ok',
                'code' => 200
            ]);
        }
        return redirect('categories')->with('status', $message);
    }

    public function edit($id)
    {
        return redirect()->back()->with('status', 'В розробці');
        $category = Category::findOrFail($id);
        return view('categories.form', compact('category'));
    }

    public function save(Request $request)
    {
        return redirect()->back()->with('status', 'В розробці');
        $this->validate($request, [
            'name' => 'required|max:255|unique:categories,name,id,' . $request->id,
            'comment' => 'max:255',
            ]);
    }
}
