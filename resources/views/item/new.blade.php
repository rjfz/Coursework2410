@extends('layouts.app')
<!--the page for adding a new item --> 
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--if it exists 'update' if it doesn't 'create' -->
    @if (isset($item))
        <form action="/item/update/{{ $item->id }}" method="post">
    @else
        <form action="/item/create" method="post">
    @endif
        @csrf
        <div class="form-group row">
            <label class="col-sm-4" for="category_id">Category</label>
            <div class="col-sm-8">
                <select class="form-control text-capitalize" id="category_id" name="category_id">
                    <option></option>

                    @foreach($categories as $category)
                        @if (isset($item))
                            Yes
                            @if ($item->category_id == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div> <!--This is mainly just cp'ing the same thing for each different value required for the item --> 
        <div class="form-group row">
            <label class="col-sm-4" for="date_reported">Date Reported</label>
            <div class="col-sm-8">
                @if (isset($item))
                    <input value="{{ $item->date_reported->format('Y-m-d') }}" type="date" class="form-control" id="date_reported" name="date_reported" aria-describedby="date_reported">
                @else
                    <input type="date" class="form-control" id="date_reported" name="date_reported" aria-describedby="date_reported">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="date_found">Date Found</label>
            <div class="col-sm-8">
                @if (isset($item))
                    <input value="{{ $item->date_found->format('Y-m-d') }}" type="date" class="form-control" id="date_found" name="date_found" aria-describedby="date_found">
                @else
                    <input type="date" class="form-control" id="date_found" name="date_found" aria-describedby="date_found">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="description">Description</label>
            <div class="col-sm-8">
                @if (isset($item))
                    <input value="{{ $item->description }}" type="text" class="form-control" id="description" name="description" aria-describedby="description">
                @else
                    <input type="text" class="form-control" id="description" name="description" aria-describedby="description">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="route_lost_on">Route Lost On</label>
            <div class="col-sm-8">
            @if (isset($item))
                    <input value="{{ $item->route_lost_on }}" type="text" class="form-control" id="route_lost_on" name="route_lost_on" aria-describedby="route_lost_on">
                @else
                <input type="text" class="form-control" id="route_lost_on" name="route_lost_on" aria-describedby="route_lost_on">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="found_location">Found Location</label>
            <div class="col-sm-8">
                @if (isset($item))
                    <input value="{{ $item->found_location }}" type="text" class="form-control" id="found_location" name="found_location" aria-describedby="found_location">
                @else
                    <input type="text" class="form-control" id="found_location" name="found_location" aria-describedby="found_location">
                @endif
            </div>
        </div>

        <button type="submit" name="submit_details" class="btn btn-primary">Submit</button>
    </form>

    <hr>
 <!-- basically allows for adding images --> 
    @if (isset($item))
        <div class="row">
            @foreach ($item->images as $image)
                <div class="col-lg-3 col-md-4 mb-4">
                    <img src="/images/{{ $image->path }}" class="img-fluid" />
                    <form action="/item/update/change_photo/{{ $item->id }}/{{ $image->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" class="form-control">
                        <input type="submit" name="submit_updated_image" value="Change image" class="btn btn-primary mt-3">
                    </form>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-4 mb-4">
                <form action="/item/update/add_photo/{{ $item->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="form-control">
                    <input type="submit" name="submit_new_image" value="Upload image" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    @endif
@endsection
