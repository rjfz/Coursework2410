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
        if (!(Auth::user())) {
            return redirect('home')->with('status', 'You must be logged in to access this page.');
        }

        $item = Item::with(['category', 'images'])->find($item_id);

        return view('item.show', ['item' => $item]);
    }

    public function new() {
        $categories = Category::all();

        return view('item.new', ['categories' => $categories]);
    }

    public function create(Request $request) {
        // dd($request->all()); sets these fields to be required in order for the item submission to be valid
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
            'reported_by' => Auth::user()->id //sets to the id of the user who submits
        ]);

        return redirect('/item/edit/'.$item->id);
    }

    public function edit($item_id) {
        $categories = Category::all();

        $item = Item::with('images')->find($item_id); 
        return view('item.new', ['categories' => $categories, 'item' => $item]);
    }

    public function update(Request $request, $item_id) { //function for the user to update the details of an item
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

        $validatedData = $request->validate([                          //specifies file types allowed as per security requirements.
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $imageName = time().'.'.$validatedData['image']->getClientOriginalExtension();

        $validatedData['image']->move(public_path('images'), $imageName);

        Image::create([ //create a path and id for the image
            'item_id' => $item_id,
            'path' => $imageName
        ]);

        return redirect('/item/edit/'.$item_id); //once uploaded redirect them back to the same edit page for that item
    }

    public function change_photo(Request $request, $item_id, $image_id) {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$validatedData['image']->getClientOriginalExtension();

        $validatedData['image']->move(public_path('images'), $imageName);

        Image::find($image_id)->update([  //finds where the current image is and overwrites it.
            'item_id' => $item_id,
            'path' => $imageName
        ]);

        return redirect('/item/edit/'.$item_id);
    }

    public function request_item($item_id) {
        $item = Item::with('category')->find($item_id);
        return view('/item/request', ['item' => $item]); //returns the request page for that specific item using their item id.
    }

    public function create_request(Request $request) { //gets the id of the user and item for the request
        $user_id = $request->get('user_id'); 
        $item_id = $request->get('item_id');

        $validatedData = $request->validate([ //to process the request, their user id, the id of the item and the details of the request is required.
            'user_id' => 'required',
            'item_id' => 'required',
            'details' => 'required',
        ]);

        if (ItemRequest::where('user_id', $user_id)->where('item_id', $item_id)->count() > 0) { //if the number of requests on that item exceeds 0 they can't request it again.
            return redirect('/home')->with('status', 'This request was not recorded, requests can only be submitted once.');
        }

        ItemRequest::create([
            'user_id' => $validatedData['user_id'],
            'item_id' => $validatedData['item_id'],
            'details' => $validatedData['details'],
            'approval_status' => 'pending' //automatically sets the item request to pending
        ]);

        return redirect('/home')->with('status', 'Request successfully submitted.'); //redirects the user home
    }
}
