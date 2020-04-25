<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class HomeController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $items = Item::with(['category', 'images'])->where('approval_state', 'approved')->get();
        $categories = Category::all();

        return view('home', ['categories' => $categories, 'items' => $items]);
    }

    public function welcome() {
        return view('welcome');
    }
}
