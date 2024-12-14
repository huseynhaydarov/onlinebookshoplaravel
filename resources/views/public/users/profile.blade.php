@extends('layouts.user-master')

@section('content')
    <div class="container">
        <h4 class="my-4 p-3 bg-light">Профиль</h4>

        <div class="row">
            <div class="col-lg-6">
                    <div class="card card-body my-3 d-flex flex-row">
                        <div class="user-avatar mr-3">
                            <img src="{{Auth::user()->image? Auth::user()->image_url:Auth::user()->default_img}}" width="100" alt="">
                        </div>

                        <div class="user-info">
                            <h5 class="my-3">{{Auth::user()->name}}</h5>
                            <p><i class="fas fa-envelope mr-2"></i> {{Auth::user()->email}}</p>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-body my-3">
                    <h6>Активность</h6>
                    <p><a href="{{route('user.orders')}}" class="mr-2"><i class="fas fa-shopping-basket mr-1"></i> Заказы</a> {{Auth::user()->orders? Auth::user()->orders->count(): 'Заказов нет'}}</p>
                    <p><a href="{{route('user.reviews')}}" class="mr-2"><i class="fas fa-comments mr-1"></i> Отзывы</a> {{Auth::user()->reviews? Auth::user()->reviews->count(): 'Отзывов нет'}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
