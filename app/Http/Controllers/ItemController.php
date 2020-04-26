<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Category;
use App\Image;
use App\ItemRequest;

class ItemController extends Controller {
    public function index() {
        $items = Item::all()->get();

        return $items->toJson();
    }

    public function show($item_id) {
        $item = Item::with(['category', 'images'])->find($item_id);

        return view('item.show', ['item' => $item]);
    }

    public function new() {
        $categories = Category::all();

        return view('item.new', ['categories' => $categories]);
    }

    public function create(Request $request) {
        // dd($request->all());
        $validatedData = $request->validate([
            'category_id' => 'required',
            'date_reported' => 'required',
            'date_found' => 'required',
            'description' => 'required|max:255',
            'found_location' => 'required|max:255',
            'route_lost_on' => 'max:255'
        ]);

        $item = Item::create([
            'category_id' => $validatedData['category_id'],
            'date_reported' => $validatedData['date_reported'],
            'date_found' => $validatedData['date_found'],
            'description' => $validatedData['description'],
            'found_location' => $validatedData['found_location'],
            'route_lost_on' => $validatedData['route_lost_on'],
            'reported_by' => Auth::user()->id
        ]);

        return redirect('/item/edit/'.$item->id);
    }

    public function edit($item_id) {
        $categories = Category::all();

        $item = Item::with('images')->find($item_id);
        return view('item.new', ['categories' => $categories, 'item' => $item]);
    }

    public function update(Request $request, $item_id) {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'date_reported' => 'required',
            'date_found' => 'required',
            'description' => 'required|max:255',
            'found_location' => 'required|max:255',
            'route_lost_on' => 'max:255'
        ]);

        $item = Item::with('images')->find($item_id);

        $item->update([
            'category_id' => $validatedData['category_id'],
            'date_reported' => $validatedData['date_reported'],
            'date_found' => $validatedData['date_found'],
            'description' => $validatedData['description'],
            'found_location' => $validatedData['found_location'],
            'route_lost_on' => $validatedData['route_lost_on']
        ]);

        return redirect('/item/edit/'.$item->id);
    }

    public function add_photo(Request $request, $item_id) {
        // dd($request);

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $imageName = time().'.'.$validatedData['image']->getClientOriginalExtension();

        $validatedData['image']->move(public_path('images'), $imageName);

        Image::create([
            'item_id' => $item_id,
            'path' => $imageName
        ]);

        return redirect('/item/edit/'.$item_id);
    }

    public function change_photo(Request $request, $item_id, $image_id) {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$validatedData['image']->getClientOriginalExtension();

        $validatedData['image']->move(public_path('images'), $imageName);

        Image::find($image_id)->update([
            'item_id' => $item_id,
            'path' => $imageName
        ]);

        return redirect('/item/edit/'.$item_id);
    }

    public function request_item($item_id) {
        $item = Item::with('category')->find($item_id);
        return view('/item/request', ['item' => $item]);
    }

    public function create_request(Request $request) {
        $user_id = $request->get('user_id');
        $item_id = $request->get('item_id');

        $validatedData = $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'details' => 'required',
        ]);

        if (ItemRequest::where('user_id', $user_id)->where('item_id', $item_id)->count() > 0) {
            return redirect('/home')->with('status', 'This request was not recorded, requests can only be submitted once.');
        }

        ItemRequest::create([
            'user_id' => $validatedData['user_id'],
            'item_id' => $validatedData['item_id'],
            'details' => $validatedData['details'],
            'approval_status' => 'pending'
        ]);

        return redirect('/home')->with('status', 'Request successfully submitted.');
    }
}
