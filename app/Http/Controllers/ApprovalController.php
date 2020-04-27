<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\ItemRequest;


class ApprovalController extends Controller
{
    public function pending_approvals() {
        if (Auth::user()) {
            if (Auth::user()->role != 'admin') { //if they are a user, they are redirected
                return redirect('home')->with('status', 'You need to be an admin to access this page.');
            }
        } else {
            return redirect('home')->with('status', 'You must be logged in to access this page.'); //if they aren't logged in, they receive this alert.
        }
 
        $items = Item::with(['category', 'images'])->where("approval_state", "pending")->get(); //gets items and their image/category if their approval state is set to pending 
        $categories = Category::all();

        return view('item.pending_approvals', ['categories' => $categories, 'items' => $items]); //returns view of items that are pending approval
    }

    public function pending_requests() {
        if (Auth::user()) {
            if (Auth::user()->role != 'admin') { //redirected if not an admin
                return redirect('home')->with('status', 'You need to be an admin to access this page.');
            }
        } else {
            return redirect('home')->with('status', 'You must be logged in to access this page.'); //redirected if they aren't logged in
        }

        $requests = ItemRequest::where("approval_status", "pending")->get(); //gets pending requests

        return view('item.pending_requests', ['requests' => $requests]); //returns the pending requests
    }

    public function approve_item($item_id) {
        Item::find($item_id)->update(['approval_state' => 'approved']);
        return redirect('/item/approvals')->with('status', 'Item successfully approved.'); //updates approval state to approved if admin approves
    }

    public function deny_item($item_id) {
        Item::find($item_id)->update(['approval_state' => 'denied']);
        return redirect('/item/approvals')->with('status', 'Item successfully denied.'); //updates the approval status to denied if the admin presses deny
    }

    public function approve_request($request_id) {
        $item_request = ItemRequest::find($request_id); //finds the request id
        $item_request->update(['approval_status' => 'approved']); //sets the approval status of the request to approved
        ItemRequest::where('item_id', $item_request->item_id)->where('id', '!=', $item_request->id)->update(['approval_status' => 'denied']); //denies requests that do not match the approved request id
        $item_request->item->update(['approval_state' => 'found']); //changes the approval state of the item to found if it has a approved request
        return redirect('/item/requests')->with('status', 'Request successfully approved.');
    }

    public function deny_request($request_id) {
        ItemRequest::find($request_id)->update(['approval_status' => 'denied']);
        return redirect('/item/requests')->with('status', 'Request successfully denied.');
    }
}
