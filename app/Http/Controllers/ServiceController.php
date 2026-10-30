<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->paginate(8)
            ->withQueryString();

        $categories = Category::all();

        return view('services.index', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = Service::with(['category', 'staff'])->findOrFail($id);

        return view('services.show', compact('service'));
    }
}
