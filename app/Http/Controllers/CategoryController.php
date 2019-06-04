<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
        {
            return response()->json(Category::all(),200);
        }

        public function store(Request $request)
        {
            $category = Category::create([
                'name' => $request->name
            ]);

            return response()->json([
                'status' => (bool) $category,
                'data'   => $category,
                'message' => $category ? 'category Created!' : 'Error Creating category'
            ]);
        }

        public function show(Category $category)
        {
            return response()->json($category,200); 
        }

        
        public function update(Request $request, Category $category)
        {
            $status = $category->update(
                $request->only(['name'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'category Updated!' : 'Error Updating category'
            ]);
        }

        

        public function destroy(Category $category)
        {
            $status = $category->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'category Deleted!' : 'Error Deleting category'
            ]);
        }
    }