@extends('layouts.user-master')

@section('content')
<div class="container">
    @include('layouts.includes.flash-message')
    <h4 class="my-4 p-4 bg-light">Мои заказы</h4>

    @if($myOrders->count())
        <table class="table table-borderless table-striped mb-4">
            <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th scope="col">Тип оплаты</th>
                    <th scope="col">Общая стоимость</th>
                    <th scope="col">Статус заказа</th>
                    <th scope="col">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->payment_type }}</td>
                        <td>{{ $order->total_price }}с</td>
                        <td>
                            @if($order->order_status == 0)
                                <span class="text-danger">Ожидание</span>
                            @else
                                <span class="text-success">Принят</span>
                            @endif
                        </td>
                        <td><a href="{{ route('order.details', $order->id) }}">Детали заказа</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">У вас еще нет заказов.</p>
    @endif
</div>
@endsection
