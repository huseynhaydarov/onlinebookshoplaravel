@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Книги</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('books.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Добавить книгу
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="{{route('books.index')}}">Все книги</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.discountBooks')}}">Книги со скидкой</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.trash-books')}}">Удаленные книги</a></span>
                </div>
            </div>
        </div>

        @if(isset($discount_books))
            <div class="alert alert-primary"><strong>{{$discount_books}}</strong></div>
        @endif
        @include('layouts.includes.flash-message')
        <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Список всех книг</h6>
            </div>
            <div class="card-body">
                @if($books->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Действие</th>
                            <th>Изображение</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Автор</th>
                            <th>Обычная цена</th>
                            <th>Скидка</th>
                            <th>Цена</th>
                            <th>Количество</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Действие</th>
                            <th>Изображение</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Автор</th>
                            <th>Обычная цена</th>
                            <th>Скидка</th>
                            <th>Цена</th>
                            <th>Количество</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminBooksController@destroy', $book->id]]) !!}
                                <div class="action d-flex flex-row">
                                    <a href="{{route('books.edit', $book->id)}}" class="btn-primary btn btn-sm mr-2"><i class="fas fa-edit"></i></a>

                                    <button type="submit" onclick="return confirm('Книга будет перемещена в корзину! Вы уверены, что хотите удалить?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                                {!! Form::close() !!}
                            </td>
                            <td><img src="{{$book->image_url}}" width="60" height="70" alt=""></td>
                            <td><a href="{{route('books.edit', $book->id)}}">{{$book->title}}</a></td>
                            <td>{{$book->category->name}}</td>
                            <td>{{$book->author->name}}</td>
                            <td>{{$book->init_price}}</td>
                            <td>{{$book->discount_rate}}%</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->quantity}}</td>
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
