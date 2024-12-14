@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Все заказы</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="#">Все заказы</a> |</span>
                    <span class="mr-2"><a href="#">Ожидающие заказы</a></span>
                </div>
            </div>
        </div>

    {{--Сообщение об успешном выполнении--}} 
    @include('layouts.includes.flash-message')

    <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Список заказов</span>
            </div>
            <div class="card-body">
                @if($orders->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Действие</th>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Оплата</th>
                                <th>Общая стоимость</th>
                                <th>Статус заказа</th>
                                <th>Детали</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Действие</th>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Оплата</th>
                                <th>Общая стоимость</th>
                                <th>Статус заказа</th>
                                <th>Детали</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'route'=> ['orders.destroy', $order->id]]) !!}
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-times"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->payment_type}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        @if($order->order_status == 1)
                                        {!! Form::open(['method'=>'PATCH', 'route'=>['orders.update', $order->id]]) !!}
                                            <input type="hidden" name="order_status" value="0">
                                          <button type="submit" class="btn btn-success btn-sm">Принято</button>
                                        {!! Form::close() !!}
                                        @else
                                            {!! Form::open(['method'=>'PATCH', 'route'=>['orders.update', $order->id]]) !!}
                                            <input type="hidden" name="order_status" value="1">
                                            <button type="submit" class="btn btn-warning btn-sm">Ожидает</button>
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                    <td><a href="{{route('orders.show', $order->id)}}">Детали заказа</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
