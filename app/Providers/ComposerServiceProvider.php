<?php

namespace App\Providers;

use App\Book;
use App\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Инициализация сервисов.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Загрузка категорий в представления боковой панели
         */
        view()->composer('layouts.includes.side-bar', function ($view){

            $categories = Category::with('books')->orderBy('name', 'asc')->get();
            return $view->with('categories', $categories);
        });

        /*
         * Загрузка недавних книг в представления боковой панели
         */
        view()->composer('layouts.includes.side-bar', function ($view){
            $recentBooks = Book::latestFirst()->take(4)->get();
            return $view->with('recent_books', $recentBooks);
        });
    }
}
