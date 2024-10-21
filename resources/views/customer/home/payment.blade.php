@extends('customer.layouts.master')
@section('content')

<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="card col-10 offset-1 shadow-sm">
           <div class="row">
            <div class="col-5">
                <h5 class="mb-3 h4">Payment methods</h5>
                @foreach ($payment as $item )
           <div class="">
          <b>  {{$item->type}}</b>(Name: {{$item->account_name}})
           </div>

           Account: {{$item->account_number}}
           <hr>
                @endforeach
            </div>
            
           </div>
        </div>

        </div>

</div>
@endsection
