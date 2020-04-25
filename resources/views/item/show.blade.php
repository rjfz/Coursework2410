@extends('layouts.app')

@section('content')

        <div class="form-group row">
            <label class="col-sm-4" for="category_id">Category</label>
            <div class="col-sm-8 text-capitalize">
                {{ $item->category->name }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="date_reported">Date Reported</label>
            <div class="col-sm-8">
            {{ $item->date_reported }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="date_found">Date Found</label>
            <div class="col-sm-8">
            {{ $item->date_found}}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="description">Description</label>
            <div class="col-sm-8">
            {{ $item->description}}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="route_lost_on">Route Lost On</label>
            <div class="col-sm-8">
            {{ $item->route_lost_on }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4" for="found_location">Found Location</label>
            <div class="col-sm-8">
            {{ $item->found_location }}
            </div>
        </div>



    <hr>

    @if (isset($item))
        <div class="row">
            @foreach ($item->images as $image)
                <div class="col-lg-3 col-md-4 mb-4">
                    <img src="/images/{{ $image->path }}" class="img-fluid" />

                </div>
            @endforeach
        </div>
    @endif
@endsection
