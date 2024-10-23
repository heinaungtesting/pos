@extends('admin.layouts.master')
@section('admin')
<div class="container-fluid">
    <a href="{{route('orderlist')}}" class="text-black m-3"><i class="fa-solid fa-arrow-left-long"></i>Back</a>
    <div class="row">
        <div class="card col-5 shadow-sm m-4 col">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5">Name:</div>
                    <div class="col-7">{{$paydata->user_name}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Phone:</div>
                    <div class="col-7">@if ($paydata->phone !=$order[0]->user_phone){{$paydata->phone}}/ @endif{{$order[0]->user_phone}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Address:</div>
                    <div class="col-7">{{$paydata->address}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Order Code:</div>
                    <div class="col-7" id="ordercode">{{$paydata->order_code}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Order Date:</div>
                    <div class="col-7">{{$paydata->created_at->format('j-F-Y')}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Total Price:</div>
                    <div class="col-7">{{$paydata->total_amt}}yen
                        <br>
                        <small class="text-danger ms-1">(contain delivary charges)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-5 shadow-sm m-4 col">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5">Contact Phone:</div>
                    <div class="col-7">{{$paydata->phone}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Payment Method:</div>
                    <div class="col-7">{{$paydata->payment_method}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Purchase Date:</div>
                    <div class="col-7">{{$paydata->created_at->format('j-F-Y h:m')}}</div>
                </div>
                <div class="row mb-3">
                    <img src="{{asset('/payslip/'.$paydata->payslip_image)}}" style="width: 150px" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover shadow-sm" id="producttable">
                    <thead class="bg-primary text-white">
                       <tr>
                        <th class="col-2">Image</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Avaliable Stock</th>
                        <th>Product Price</th>
                        <th>Total Price</th>
                       </tr>
                    </thead>
                    <tbody>
                      @foreach ($order as $item)
                      <tr>
                        <input type="hidden" name="" class="productid" value="{{$item->product_id}}">
                        <input type="hidden" name="" class="ordercount" value="{{$item->order_count}}">
                        <td><img src="{{asset('product/'.$item->product_image)}}" class="w-50 img-thumbnail" alt=""></td>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->order_count}}</td>
                        <td>{{$item->stock}}@if ($item->stock < $item->order_count) <span class="text-danger">(out of Stock)</span> @endif</td>
                        <td>{{$item->product_price}}yen</td>
                        <td>{{$item->order_count * $item->product_price}}yen</td>
                       </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">

            <input type="button" id="reject" class="btn btn-danger round shadow-sm" value="Cancel">
                <input type="button" id="confirm" @if($status==false) disabled @endif class="btn btn-success round shadow-sm" value="Confirm">


        </div>
    </div>
</div>
@endsection
@section('scriptscr')
<script>
    $(document).ready(function(){
        $('#confirm').click(function(){
            $list=[]
            $ordercode=$('#ordercode').text();
            $('#producttable tbody tr').each(function(index,row){
                $productid=$(row).find('.productid').val();
                $ordercount=$(row).find('.ordercount').val();
         $list.push({
            'product_id': $productid,
            'order_count': $ordercount,
            'order_code': $ordercode
         }

         )


        })

$.ajax({
    type: 'get',
    url: '/admin/order/confirm',
    data: Object.assign({},$list),
    dataType: 'json',
    success: function(res){
        res.status=='success' ? location.href='/admin/order/list' : ''
    }
})
        })

    $('#reject').click(function(){

        $data={
     'order_code': $('#ordercode').text()
        }
        $.ajax({
            type: 'get',
            url: '/admin/order/reject',
            data: $data,
            dataType: 'json',
            success: function(res){
                res.status=='success' ? location.href='/admin/order/list' : ''
            }
        })
    })
    })
</script>
@endsection
