@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h1>Dashboard</h1>

        @if (session('status'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (Auth::user())
            <a href="/item/new" class="btn btn-primary my-3">New item</a><br />
        @endif
        <div id="home_component"></div>
        <div id="home_component_props" data-items="{{ $items }}" data-categories="{{ $categories }}" data-requests="true" data-user="{{ Auth::user() }}"></div>
    </div>
</div>
@endsection
