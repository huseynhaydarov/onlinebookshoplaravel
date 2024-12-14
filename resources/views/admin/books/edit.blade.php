@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Редактировать книгу</h1>

        <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="mr-3"><a href="{{route('books.index')}}" class="btn btn-secondary"><i class="fas fa-long-arrow-alt-left"></i> Назад</a></span>
                <span class="m-0 font-weight-bold text-primary">Форма редактирования книги</span>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="display-img text-center p-4">
                        <img src="{{$book->image? $book->image_url:$book->default_img}}" alt="">
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card-body">
                        {!! Form::model($book, ['method'=>'PATCH', 'action'=>['Admin\AdminBooksController@update', $book->id], 'files'=>true]) !!}

                        <div class="form-group">
                            {!! Form::label('title') !!} <!-- Название -->
                            {!! Form::text('title', null, ['class'=>'form-control '.($errors->has('title')? 'is-invalid': '')]) !!}
                            @if($errors->has('title'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('title')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug') !!} <!-- ЧПУ -->
                            {!! Form::text('slug', null, ['class'=>'form-control '.($errors->has('slug')? 'is-invalid': '')]) !!}
                            @if($errors->has('slug'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('slug')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('description') !!} <!-- Описание -->
                            {!! Form::textarea('description', null, ['class'=>'form-control '.($errors->has('description')? 'is-invalid': ''), 'rows'=>10]) !!}
                            @if($errors->has('description'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('description')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('author_id', 'Автор') !!} <!-- Автор -->
                            {!! Form::select('author_id', App\Author::pluck('name', 'id'), null,['placeholder'=>'Выберите автора','class'=>'form-control '.($errors->has('author_id')? 'is-invalid': '')]) !!}
                            @if($errors->has('author_id'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('author_id')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'Категория') !!} <!-- Категория -->
                            {!! Form::select('category_id', App\Category::pluck('name', 'id'), null,['placeholder'=>'Выберите категорию','class'=>'form-control '.($errors->has('category_id')? 'is-invalid': '')]) !!}
                            @if($errors->has('category_id'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('category_id')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('init_price', 'Обычная цена') !!} <!-- Обычная цена -->
                            {!! Form::text('init_price', null, ['class'=>'form-control '.($errors->has('init_price')? 'is-invalid': '')]) !!}
                            @if($errors->has('init_price'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('init_price')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('discount_rate', 'Скидка') !!} <!-- Скидка -->
                            {!! Form::text('discount_rate', null, ['class'=>'form-control '.($errors->has('discount_rate')? 'is-invalid': '')]) !!}
                            @if($errors->has('discount_rate'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('discount_rate')}}</strong>
                        </span>
                            @endif
                        </div>
                        <input type="hidden" name="price">

                        <div class="form-group">
                            {!! Form::label('quantity') !!} <!-- Количество -->
                            {!! Form::text('quantity', null, ['class'=>'form-control '.($errors->has('quantity')? 'is-invalid': '')]) !!}
                            @if($errors->has('quantity'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('quantity')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('image_id', 'Изображение книги') !!} <!-- Изображение книги -->
                            {!! Form::file('image_id', ['class'=>'form-control '.($errors->has('image_id')? 'is-invalid': '')]) !!}
                            <small>Максимальный размер 1МБ</small>
                            @if($errors->has('image_id'))
                                <span class="invalid-feedback">
                            <strong>{{$errors->first('image_id')}}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Обновить', ['class'=>'btn btn-warning']) !!} <!-- Обновить -->
                            {!! Form::reset('Сбросить', ['class'=>'btn btn-danger']) !!} <!-- Сбросить -->
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        /*
         автоматическое создание ЧПУ
        */
        $('#title').on('blur', function() {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug');
            var theSlug = theTitle.replace(/&/g, '-and-')
                .replace(/[^a-z0-9-]+/g, '-')
                .replace(/--+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });
    </script>
@endsection
