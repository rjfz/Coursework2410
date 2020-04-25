@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1>Pending requests</h1>
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Item</th>
                <th>Email</th>
                <th>Details</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td><img class="img-fluid" src="/images/{{ $request->item->images->first->path['path'] }}" /></td>
                        <td>{{ $request->item->description }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>{{ $request->details }}</td>
                        <td>
                            <a href="/item/request/approve/{{ $request->id }}" class="btn btn-success">Approve</a>
                        </td>
                        <td>
                            <a href="/item/request/deny/{{ $request->id }}" class="btn btn-danger">Deny</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
