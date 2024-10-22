@extends('customer.layouts.master')
@section('content')
    <div class="container" style="margin-top: 150px">
        <div class="row">
            <table class="table table-hover shadow-sm">
                <thead class="bg-primary text-white">
                    <tr>


                        <th>Date</th>
                        <th>Order Code</th>

                        <th>Order Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td>{{ $item['created_at']->format('j-F-Y') }}</td>
                            <td>{{ $item['order_code'] }}</td>

                            <td>
                              @if ($item['status']==0)
                              <span class="btn btn-warning btn-sm rounded shadow-sm">Pending</span>
                              @elseif ($item['status']==1)
                              <span class="btn btn-success btn-sm rounded shadow-sm">Success</span>
                              @else
                              <span class="btn btn-danger btn-sm rounded shadow-sm">Reject</span>

                              @endif

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
