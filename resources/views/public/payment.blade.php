@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="payment-area">
            <h4 class="my-4 bg-dark p-3 text-white">Произведите оплату</h4>

            <div class="cart-summary my-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Итог заказа</h4>
                    </div>
                    <div class="card-body">
                        <p>Всего товаров = {{Cart::content()->count()}}</p>
                        <p>Стоимость товаров = {{Cart::total()}}c</p>
                        <p>Стоимость доставки = 0.00c</p>
                        <p><strong>Общая стоимость = {{Cart::total()}}c</strong></p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 my-4">
                <form action="{{route('cart.checkout')}}" method="post">
                    @csrf
                    <input type="hidden" name="cart_total" value="{{Cart::total()}}">
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_7xVvmxzKaoeFzuBZZ18WdwKy00bmfx80CA"
                            data-amount=""
                            data-name="Книжный магазин"
                            data-description="Оплата в книжном магазине"
                            data-locale="auto">
                    </script>
                </form>
            </div>
            <div class="bg-light p-3 my-4">
                <button class="btn btn-success btn-sm"><strong>Наложенный платеж</strong></button>
            </div>
        </div>
    </div>
@endsection
