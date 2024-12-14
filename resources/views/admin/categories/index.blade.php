@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Категории</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('categories.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Добавить категорию
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="#">Скидочные книги</a> |</span>
                    <span class="mr-2"><a href="#">Удаленные книги</a></span>
                </div>
            </div>
        </div>

        {{--Сообщение об успешном выполнении--}} 
        @include('layouts.includes.flash-message')

        <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Список категорий</span>
            </div>
            <div class="card-body">
                @if($categories->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Действие</th>
                                <th>Название</th>
                                <th>Количество книг</th>
                                <th>Дата создания</th>
                                <th>Дата обновления</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Действие</th>
                                <th>Название</th>
                                <th>Количество книг</th>
                                <th>Дата создания</th>
                                <th>Дата обновления</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminCategoriesController@destroy', $category->id]]) !!}

                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                        <button type="submit" onclick="return confirm('Категория будет удалена навсегда. Все книги, связанные с этой категорией, также будут удалены. Вы уверены, что хотите удалить?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                                        {!! Form::close() !!}
                                    </td>
                                    <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                                    <td>{{$category->books->count()}}</td>
                                    <td>{{$category->created_at? $category->created_at->diffForHumans(): '-'}}</td>
                                    <td>{{$category->updated_at? $category->updated_at->diffForHumans(): '-'}}</td>
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
