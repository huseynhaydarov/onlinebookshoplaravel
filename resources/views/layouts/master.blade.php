<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Книжный Магазин - Главная')</title>
    <!-- Иконка фавикона -->
    <link rel="icon" href="{{asset('/')}}assets/img/favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/all.min.css">
    <!-- Основной CSS Bootstrap -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <!-- Ваши пользовательские стили (необязательно) -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/style.css">
</head>
<body>
<!-- НАВИГАЦИОННАЯ ПАНЕЛЬ -->
    @include('layouts.includes.navbar')
<!-- КОНЕЦ НАВИГАЦИОННОЙ ПАНЕЛИ -->
<!-- ЗАГОЛОВОК -->
<section class="header py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="headings">
                    <h3><a href="{{route('bookshop.home')}}" class="text-secondary"><b class="text-danger">Книга</b> Магазин</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{route('all-books')}}">
                    <div class="input-group input-group-sm m-1">
                        <input type="text" name="term" value="{{request('term')}}" class="form-control" placeholder="Поиск книги..">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">Поиск</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="shopping-cart text-right">
                    <a href="{{route('cart')}}" class="text-danger"><i class="fas fa-shopping-cart fa-2x m-1"></i>
                        @if(Cart::content()->count())
                            <span class="count-cart">{{Cart::content()->count()}}</span>
                        @endif
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- КОНЕЦ ЗАГОЛОВКА -->

@yield('content')

<footer class="py-3 text-center border-top bg-light">
    <div class="container">
        <div class="go-to-top mb-2">
            <a href="#nav-top" class="text-muted" title="Вернуться к началу"><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="footer-text">
            Авторское право &copy; Система управления книжным магазином. Все права защищены. <span id="year"></span>
        </div>
        <div class="social-icon mt-2">
        <span class="mr-2">
          <a href="#" class="text-primary"><i class="fab fa-facebook fa-2x"></i></a>
        </span>
            <span class="mr-2">
          <a href="#" class="text-secondary"><i class="fab fa-github fa-2x"></i></a>
        </span>
            <span class="mr-2">
          <a href="#" class="text-warning"><i class="fab fa-stack-overflow fa-2x"></i></a>
        </span>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script type="text/javascript" src="{{asset('/')}}assets/js/jquery.min.js"></script>
<!-- Подсказки Bootstrap -->
<script type="text/javascript" src="{{asset('/')}}assets/js/popper.min.js"></script>
<!-- Основной JavaScript Bootstrap -->
<script type="text/javascript" src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<!-- Ваши пользовательские скрипты (необязательно) -->
<script type="text/javascript" src="{{asset('/')}}assets/js/script.js"></script>

</body>
</html>
