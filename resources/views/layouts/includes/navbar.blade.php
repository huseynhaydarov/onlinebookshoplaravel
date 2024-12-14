<nav class="navbar navbar-expand-sm text-white navbar-white p-1 border-bottom" id="nav-top">
    <div class="container">
        <a href="{{route('bookshop.home')}}" class="logo-img"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-collapse">
            <ul class="navbar-nav ">
                <li class="nav-item px-2 ">
                    <a href="{{route('bookshop.home')}}" class="nav-link">Главная</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{route('all-books')}}" class="nav-link">Книги</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{route('discount-books')}}" class="nav-link">Скидки на книги</a>
                </li>
                <li class="nav-item px-2">
                    <a href="#" class="nav-link">О нас</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(Auth::check() == false)
                    <li class="nav-item px-2">
                        <a href="{{url('login')}}" class="nav-link text-danger"><i class="fas fa-user-lock"></i> Вход</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('register')}}" class="nav-link"><i class="fas fa-user"></i> Регистрация</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                            <span class="image-circle"><img src="{{Auth::user()->image? Auth::user()->image_url:Auth::user()->default_img}}" width="30" alt=""></span>
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu">
                            @if(Auth::user()->role->name == "Admin")
                                <a class="dropdown-item" href="{{route('admin.home')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    Профиль
                                </a>
                            @elseif(Auth::user()->role->name == "User")
                                <a class="dropdown-item" href="{{route('user.home')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    Профиль
                                </a>
                            @else
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    Профиль
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-muted"></i>
                                Выход
                            </a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
