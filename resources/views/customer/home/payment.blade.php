@extends('customer.layouts.master')
@section('content')
    <div class="container" style="margin-top: 150px">
        <div class="row">
            <div class="card col-10 offset-1 shadow-sm">
                <div class="row">
                    <div class="col">
                        <h5 class="mb-3 h4">Payment methods</h5>
                        @foreach ($payment as $item)
                            <div class="">
                                <b> {{ $item->type }}</b>(Name: {{ $item->account_name }})
                            </div>

                            Account: {{ $item->account_number }}
                            <hr>
                        @endforeach
                    </div>
                    <div class="col-8">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                Payment Info
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <form action="{{route('productorder')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-4">
                                            <div class="col">
                                                <input value="{{old('name')}}" type="text" name="name" class="form-control @error('name') is-invalid

                                                @enderror"
                                                    placeholder="User Name.." id="">
                                            </div>
                                            <div class="col">
                                                <input value="{{old('phone')}}" type="text" name="phone" class="form-control @error('phone') is-invalid

                                                @enderror"
                                                    placeholder="Phome Name.." id="">
                                            </div>
                                            <div class="col">
                                                <input value="{{old('address')}}" type="text" name="address" class="form-control @error('address') is-invalid

                                                @enderror"
                                                    placeholder="Address.." id="">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <select name="paymenttype" class="form-select @error('paymenttype') is-invalid

                                                @enderror">
                                                    <option value="">Choose Payment Methods</option>
                                                    @foreach ($payment as $item)
                                                        <option value="{{ $item->type }}" @if (old('paymenttype')==$item->type) selected

                                                        @endif>{{ $item->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="file" name="payslipimage" class="form-control @error('payslipimage') is-invalid

                                                @enderror" id="">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <input type="hidden" name="ordercode" value="{{$orderproduct[0]['order_code']}}">
                                                Order Code: <span
                                                    class="text-secondary fw-bold">{{ $orderproduct[0]['order_code'] }}</span>
                                            </div>
                                            <div class="col">
                                                <input type="hidden" name="total" value="{{ $orderproduct[0]['total'] }}">
                                                Total Amt: <span
                                                    class=" fw-bold">{{ $orderproduct[0]['total'] }}yen</span>
                                            </div>
                                        </div>
                                        <div class="row mt-4 mx-2">
                                            <button type="submit" class="btn btn-outline-success w-100" > <i class="fa-solid fa-cart-shopping me-3"></i>Order Now..</button>
                                           </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
