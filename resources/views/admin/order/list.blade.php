@extends('admin.layouts.master')
@section('admin')
<div class="container">
    <div class="d-flex justify-content-end ">

        <div class="">
            <form action="{{route('orderlist')}}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" value="{{request('key')}}" name="key" id="" class="form-control" placeholder="Enter Search Key...">
                    <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover shadow-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>UserName</th>
                        <th>Action</th>

                        <th></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($order as  $item)
                    <tr>
                        <input type="hidden" name="" value="{{$item->order_code}}" class='ordercode'>
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                        <td><a href="{{route('orderdetail',$item->order_code)}}">{{$item->order_code}}</a></td>
                        <td>{{$item->user_name}}</td>
                        <td>
                            <select name="" class="form-select statuschange" id="">
                           <option value="0" @if ($item->status==0) selected

                           @endif>Pending</option>
                           <option value="1" @if ($item->status==1) selected

                           @endif>Accept</option>
                           <option value="2" @if ($item->status==2) selected

                           @endif>Reject</option>

                            </select>
                        </td>

                        <td>
                            @if($item->status==0)<span><i class="fa-solid fa-clock text-warning"></i></span>@endif
                            @if($item->status==1)<span><i class="fa-solid fa-check text-success" ></i></span>@endif
                            @if($item->status==2)<span><i class="fa-regular fa-circle-xmark text-danger"></i></span>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scriptscr')
<script>
    $(document).ready(function(){
$('.statuschange').change(function(){
    $statuschange=$(this).val()
    $ordercode=$(this).parents('tr').find('.ordercode').val();
    $data={
        'order_code': $ordercode,
        'status': $statuschange
    }

    $.ajax({
    type: 'get',
    url: '/admin/order/changestatus',
    data: $data,
    dataType: 'json',
    success: function(res){
        res.status=='success' ? location.reload() : ''
    }
})
})

    })
</script>
@endsection
