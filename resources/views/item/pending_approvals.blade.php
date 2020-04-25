@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1>Pending approvals</h1>
        <div id="home_component"></div>
        <div id="home_component_props" data-items="{{ $items }}" data-categories="{{ $categories }}" data-approvals="true" data-user="{{ Auth::user() }}"></div>
    </div>
</div>
@endsection
