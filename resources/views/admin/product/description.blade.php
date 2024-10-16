@extends('admin.layouts.master')
@section('admin')

<div class="container-fluid">
<div class="card shadow mb-4 col">
    <div class="card-header py-3">
        <div class="">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
            </div>
        </div>
    </div>

<div class="card-body">
    <div class="row col-10 offset-1">
        <div class="col-3">
            <img src="{{asset('product/'.$productde->image)}}" id="output" alt="" class="img-profile img-thumbnail">
        </div>
        <div class="col">
            <div class="row mt-3">
                <div class="col-2 h5">Name :</div>
                <div class="col h5">{{$productde->name}}</div>
            </div>
            <div class="row mt-3">
                <div class="col-2 h5">Category :</div>
                <div class="col h5">{{$productde->category_name}}</div>
            </div>
            <div class="row mt-3">
                <div class="col-2 h5">Price :</div>
                <div class="col h5">{{$productde->price}}</div>
            </div>
            <div class="row mt-3">
                <div class="col-2 h5">Stock :</div>
                <div class="col h5">{{$productde->stock}}</div>
            </div>

            <div class="row mt-3">
                <div class="col-2 h5">Description :</div>
                <div class="col h5 text-muted">{{$productde->description}}</div>

            </div>
            <a href="{{route('productupdatepage',$productde->id)}}" class="btn bg-dark text-white btn-sm mt-3 rounded shadow-sm">Edit</a>

        </div>
    </div>
</div>

    
</div>

</div>
@endsection
