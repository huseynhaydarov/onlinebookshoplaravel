@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Удаленные книги</h1>
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

    @include('layouts.includes.flash-message')
    <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Список всех удаленных книг</h6>
            </div>
            <div class="card-body">
                @if($books->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <div class="action d-flex flex-row">
                                        {!! Form::open(['method'=>'PUT', 'route'=>['book.restore', $book->id]]) !!}
                                            <button type="submit" class="btn btn-sm btn-primary mr-2" title="Восстановить"><i class="fa fa-undo"></i></button>
                                        {!! Form::close() !!}

                                        {!! Form::open(['method'=>'DELETE', 'route'=>['book.forceDelete', $book->id]]) !!}
                                            <button type="submit" onclick="return confirm('Книга будет удалена навсегда! Вы уверены, что хотите удалить?')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                        {!! Form::close() !!}
                                    </div>

                                    </td>
                                    <td><img src="{{$book->image_url}}" width="60" height="70" alt=""></td>
                                    <td><a href="#">{{$book->title}}</a></td>
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
