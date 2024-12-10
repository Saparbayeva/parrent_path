<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Kategoriyalar ro'yxati
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Yangi kategoriya formasi
    public function create()
    {
        return view('categories.create');
    }

    // Yangi kategoriya saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Kategoriyani tahrirlash formasi
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Tahrirni saqlash
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Kategoriyani o'chirish
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
