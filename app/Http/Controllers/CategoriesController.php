<?php

namespace App\Http\Controllers;

use Log;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
    
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
        $message = '✔️ Категорія "' . $category->name . '" створена!';
        Log::notice(auth()->user()->email . ' створив категорію ' . $category->name);
        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'response' => 'ok',
                'code' => 200
            ]);
        }
        return redirect('categories')->with('status', $message);
    }

    public function edit(Category $category)
    {
        return view('categories.form', compact('category'));
    }

    public function save(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'comment' => 'max:255',
        ]);
        $category->update([
                'name' => $request->name,
                'comment' => $request->comment
            ]);
        $message = '✔️ Категорія "' . $request->name . '" відредагована!';
        Log::notice(auth()->user()->email . ' відредагував категорію ' . $request->name);
        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'response' => 'ok',
                'code' => 200
            ]);
        }
        return redirect('categories')->with('status', $message);
    }

    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        $message = '✔️ Категорія "' . $category->name . '"  видалена!';
        Log::notice(auth()->user()->email . ' видалив категорію ' . $category->name);
        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'response' => 'ok',
                'code' => 200
            ]);
        }
        return redirect('categories')->with('status', $message);

    }
}
