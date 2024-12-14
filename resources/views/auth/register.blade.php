@extends('layouts.master')

@section('content')
<div class="container">
    <section class="registration-area my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">{{__('Зарегистрировать аккаунт')}}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{url('/register')}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control {{$errors->has('name')? 'is-invalid': ''}}">

                                    @if($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Электронная почта</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control {{$errors->has('email')? 'is-invalid': ''}}">

                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" name="password" class="form-control {{$errors->has('password')? 'is-invalid': ''}}">
                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('password')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-md">Зарегистрироваться</button>
                                </div>
                            </form>
                            <small>Уже есть аккаунт? <a href="{{url('login')}}">Войдите здесь</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
