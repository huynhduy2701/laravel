@extends('admin.layouts.app')
@section('title', 'orders')
@section('content')

    <div class="card">
        @csrf
        @if (session('status'))
        <div class="row">
            <h3 class="text-primary text-center">{{ session('status') }}</h3>
        </div>
    @endif
        <h1>Orders</h1>
        <div class="container-fluid pt-5">
            <div class="col card">
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>status</th>
                            <th>total</th>
                            <th>ship</th>
                            <th>customer name</th>
                            <th>customer email</th>
                            <th>customer address</th>
                            <th>note</th>
                            <th>payment</th>
                        </tr>

                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <form action="{{ route('admin.orders.update_status', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group input-group-static mb-4">
                                            <select name="status" class="form-control select-status" onchange="this.form.submit()">
                                                @foreach (config('order.status') as $status)
                                                    <option value="{{ $status }}" {{ $status == $item->status ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td>${{ $item->total }}</td>
                                <td>${{ $item->ship }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_email }}</td>
                                <td>{{ $item->customer_address }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->payment }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
