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
            if (Auth::user()->role != 'admin') {
                return redirect('home')->with('status', 'You need to be an admin to access this page.');
            }
        } else {
            return redirect('home')->with('status', 'You must be logged in to access this page.');
        }

        $items = Item::with(['category', 'images'])->where("approval_state", "pending")->get();
        $categories = Category::all();

        return view('item.pending_approvals', ['categories' => $categories, 'items' => $items]);
    }

    public function pending_requests() {
        if (Auth::user()) {
            if (Auth::user()->role != 'admin') {
                return redirect('home')->with('status', 'You need to be an admin to access this page.');
            }
        } else {
            return redirect('home')->with('status', 'You must be logged in to access this page.');
        }

        $requests = ItemRequest::where("approval_status", "pending")->get();

        return view('item.pending_requests', ['requests' => $requests]);
    }

    public function approve_item($item_id) {
        Item::find($item_id)->update(['approval_state' => 'approved']);
        return redirect('/item/approvals')->with('status', 'Item successfully approved.');
    }

    public function deny_item($item_id) {
        Item::find($item_id)->update(['approval_state' => 'denied']);
        return redirect('/item/approvals')->with('status', 'Item successfully denied.');
    }

    public function approve_request($request_id) {
        $item_request = ItemRequest::find($request_id);
        $item_request->update(['approval_status' => 'approved']);
        ItemRequest::where('item_id', $item_request->item_id)->where('id', '!=', $item_request->id)->update(['approval_status' => 'denied']);
        $item_request->item->update(['approval_state' => 'found']);
        return redirect('/item/requests')->with('status', 'Request successfully approved.');
    }

    public function deny_request($request_id) {
        ItemRequest::find($request_id)->update(['approval_status' => 'denied']);
        return redirect('/item/requests')->with('status', 'Request successfully denied.');
    }
}
