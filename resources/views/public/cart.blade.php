@extends('layouts.master')
@section('title')
    Книжный магазин - Страница корзины
@endsection

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-header bg-dark text-white">
                <h4><i class="fas fa-shopping-cart"></i> Корзина покупок</h4>
            </div>
            <div class="card-body">
                @include('layouts.includes.flash-message')
                @if(Cart::content()->count())
                <table class="table table-borderless">
                <thead class="bg-light">
                <tr>
                  <th></th>
                  <th scope="col">Изображение</th>
                  <th scope="col">Название</th>
                  <th scope="col">Цена</th>
                  <th scope="col" width="100">Количество</th>
                  <th scope="col">Подытог</th>
                </tr>
                </thead>
                    @foreach(Cart::content() as $item)
                    <tbody>
                    <tr class="border-bottom">
                      <td><a href="{{route('cart.delete' ,['id' => $item->rowId])}}" class="text-danger" title="Удалить товар из корзины"><i class="fas fa-times"></i></a></td>

                      <td><img src="{{asset('assets/img/'.$item->options->image->file)}}" alt="" width="50"></td>

                      <td>{{$item->name}}</td>

                      <td>{{$item->price}}с</td>

                      <td>
                        <span class="quantity-input mr-2 mb-2 d-flex flex-row">
                            <a href="{{route('cart.decrement', ['id' => $item->rowId, 'qty' => $item->qty])}}" class="cart-minus">-</a>
                             <input title="Количество" name="quantity" type="text" value="{{$item->qty}}" class="qty-text">
                            <a href="{{route('cart.increment', ['id' => $item->rowId, 'qty' => $item->qty, 'book_id'=> $item->id])}}" class="cart-plus">+</a>
                        </span>
                      </td>

                      <td>{{$item->subtotal()}}с</td>
                    </tr>
                    </tbody>
                    @endforeach
                <tbody>
                    <tr>
                        <td colspan="4"><a href="{{route('all-books')}}" class="text-primary">Продолжить покупки</a></td>
                        <td><strong>Итого</strong></td>
                        <td>c{{Cart::total()}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <a href="{{route('cart.checkout')}}" class="btn btn-outline-danger btn-sm">Оформить заказ <i class="fas fa-long-arrow-alt-right"></i></a>
                        </td>
                    </tr>
                </tbody>
                </table>
                @else
                    <div class="alert alert-warning">Корзина пуста. <a href="{{route('all-books')}}"> Продолжить покупки</a></div>
                @endif
            </div>
        </div>
    </div>
@endsection
