<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Админка книжного магазина - Панель управления</title>
    <!-- Иконка сайта -->
    <link rel="icon" href="{{asset('/')}}assets/img/favicon-2.png" type="image/x-icon">
    <!-- Пользовательские шрифты для этого шаблона-->
    <link href="{{asset('/')}}admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Пользовательские стили для этого шаблона-->
    <link href="{{asset('/')}}admin/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Таблица данных -->
    <link href="{{asset('/')}}admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Пользовательский CSS -->
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Обертка страницы -->
<div id="wrapper">

    <!-- Боковое меню -->
    @include('layouts.includes.admin-sidebar')
    <!-- Конец бокового меню -->

    <!-- Обертка контента -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Основной контент -->
        <div id="content">

            <!-- Верхняя панель -->
            @include('layouts.includes.admin-topbar')
            <!-- Конец верхней панели -->

            <!-- Начало содержимого страницы -->
            @yield('content')

        </div>
        <!-- Конец основного контента -->

        <!-- Подвал -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <strong>Система управления книжным магазином. Все права защищены. </strong> <span id="year"></span></span>
                </div>
            </div>
        </footer>
        <!-- Конец подвала -->

    </div>
    <!-- Конец обертки контента -->

</div>
<!-- Конец обертки страницы -->

<!-- Кнопка "Прокрутить вверх" -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Основной JavaScript Bootstrap-->
<script src="{{asset('/')}}admin/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('/')}}admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript основных плагинов-->
<script src="{{asset('/')}}admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Пользовательские скрипты для всех страниц-->
<script src="{{asset('/')}}admin/js/sb-admin-2.min.js"></script>

<!-- Плагины уровня страницы -->
<script src="{{asset('/')}}admin/vendor/chart.js/Chart.min.js"></script>

<!-- Пользовательские скрипты уровня страницы -->
<script src="{{asset('/')}}admin/js/demo/chart-area-demo.js"></script>
<script src="{{asset('/')}}admin/js/demo/chart-pie-demo.js"></script>
<!-- Плагины уровня страницы -->
<script src="{{asset('/')}}admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Пользовательские скрипты уровня страницы -->
<script src="{{asset('/')}}admin/js/demo/datatables-demo.js"></script>
@yield('script')
<script>
    $('#year').text(new Date().getFullYear())
</script>

</body>

</html>
