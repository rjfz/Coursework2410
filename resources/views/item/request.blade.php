@extends('layouts.app')

@section('content')
<form action="/item/create_request" method="post">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}" />
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
    <div class="form-group row">
        <label class="col-sm-4" for="details">Details</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="details" name="details" aria-describedby="details">
        </div>
    </div>
    <button type="submit" name="submit_details" class="btn btn-primary">Submit</button>
</form>
@endsection
