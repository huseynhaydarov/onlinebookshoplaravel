@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Заголовок страницы -->
        <h1 class="h3 mb-2 text-gray-800">Редактировать категорию</h1>

        <!-- Пример таблицы данных -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="mr-3"><a href="{{route('categories.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Назад</a></span>
                <span class="m-0 font-weight-bold text-primary">Форма редактирования категории</span>
            </div>
            <div class="card-body">
                {!! Form::model($category, ['method'=>'PATCH', 'action'=>['Admin\AdminCategoriesController@update', $category->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control '.($errors->has('name')? 'is-invalid': '')]) !!}
                    @if($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('slug') !!}
                    {!! Form::text('slug', null, ['class'=>'form-control '.($errors->has('slug')? 'is-invalid':'')]) !!}

                    @if($errors->has('slug'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('slug')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::submit('Обновить', ['class'=>'btn btn-warning']) !!}
                    {!! Form::reset('Сбросить', ['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        /*
         автоматическое создание slug
        */
        $('#name').on('blur', function() {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug');
            theSlug = theTitle.replace(/&/g, '-and-')
                .replace(/[^a-z$0-9-]+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '')

            slugInput.val(theSlug);
        });
    </script>
@endsection
