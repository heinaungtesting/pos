@extends('admin.layouts.master')
@section('admin')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>
        <div class="">




                <div class="col">
                    <table class="table table-hover shadow-sm">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>User Name</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($order as $item)

                                <td>{{$item->created_at->format('j-F-Y')}}</td>
                                <td>{{$item->order_code}}</td>
                                <td>{{$item->user_name}}</td>
                                <td>
                                    <select name="" class="form-select" id="">
                                        <option value="0" @if ($item->status==0) selected

                                        @endif>Pending</option>
                                        <option value="1" @if ($item->status==1) selected

                                        @endif>Accept</option>
                                        <option value="2" @if ($item->status==2) selected

                                        @endif>Reject</option>
                                    </select>
                                </td>
                                <td>
                                    <span><i class="fa-solid fa-clock text-warning"></i></span>
                                    <span><i class="fa-solid fa-check text-success"></i></span>
                                    <span><i class="fa-regular fa-circle-xmark text-danger"></i></span>
                                </td>
@endforeach
                        </tbody>
                    </table>


                

        </div>
    </div>
@endsection
