@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Авторы</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('authors.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Добавить авторов
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="#">Скидочные книги</a> |</span>
                    <span class="mr-2"><a href="#">Книги в корзине</a></span>
                </div>
            </div>
        </div>

        @include('layouts.includes.flash-message')

        <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Список авторов</h6>
            </div>
            <div class="card-body">
                @if($authors->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Действие</th>
                                <th>Фото</th>
                                <th>Имя</th>
                                <th>Количество книг</th>
                                <th>Биография</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Действие</th>
                                <th>Фото</th>
                                <th>Имя</th>
                                <th>Количество книг</th>
                                <th>Биография</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminAuthorsController@destroy', $author->id]]) !!}
                                        <div class="action d-flex flex-row">
                                            <a href="{{route('authors.edit', $author->id)}}" class="btn-primary btn btn-sm mr-2"><i class="fas fa-edit"></i></a>

                                            <button type="submit" onclick="return confirm('Автор будет удален навсегда! Вы уверены, что хотите удалить?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                     {!! Form::close() !!}
                                    </td>
                                    <td><img src="{{$author->image? $author->image_url : $author->default_img}}" height="50" alt=""></td>
                                    <td><a href="{{route('authors.edit', $author->id)}}">{{$author->name}}</a></td>
                                    <td>{{$author->books->count()}}</td>
                                    <td>{{str_limit($author->bio, 100)}}<a href="#">читать далее</a></td>
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
