<?php

namespace App\Http\Controllers;
use App\Author; // Автор
use GrahamCampbell\Markdown\Facades\Markdown; // Markdown
use App\Book; // Книга
use App\Category; // Категория
use Illuminate\Http\Request; // Запрос

class BookshopHomeController extends Controller
{
    public function index() // Индекс
    {
        # Главная страница Книги
        $engineering_books = Book::with('category')->whereHas('category', function($query) {
            $query->where('slug', 'engineering'); })
            ->take(8) // Берём 8
            ->latestFirst() // Самые последние
            ->get();
        $literature_books = Book::with('category', 'author', 'image')
            ->whereHas('category', function ($query){
                $query->where('slug', 'literature'); })
            ->take(4) // Берём 4
            ->latestFirst() // Самые последние
            ->get();
        $discount_books = Book::with('category')
            ->where('discount_rate', '>', 0) // Где скидка больше 0
            ->orderBy('discount_rate', 'desc') // Упорядочить по скидке
            ->take(6) // Берём 6
            ->get();
        return view('public.home', compact('engineering_books', 'discount_books', 'literature_books')); // Возврат представления
    }
    
    public function allBooks() // Все книги
    {
        # ComposerServiceProvider загружается здесь
        $books = Book::with('author', 'image', 'category')
                    ->orderBy('id', 'DESC') // Упорядочить по ID
                    ->search(request('term')) // Поиск по запросу
                    ->paginate(16); // Пагинация на 16
        return view('public.book-page', compact('books')); // Возврат представления
    }
    
    public function discountBooks() // Скидки на книги
    {
        # ComposerServiceProvider загружается здесь
        $discountTitle = "Все книги со скидкой"; // Заголовок
        $books = Book::with('author', 'image', 'category')
            ->orderBy('discount_rate', 'DESC') // Упорядочить по скидке
            ->where('discount_rate', '>', 0) // Где скидка больше 0
            ->paginate(16); // Пагинация на 16
        return view('public.book-page', compact('books', 'discountTitle')); // Возврат представления
    }
    
    /*
     * Фильтрация книг по категории
     */
    public function category(Category $category) // Категория
    {
        $categoryName = $category->name; // Имя категории
        $books = $category->books() // Книги в категории
            ->with('category', 'author', 'image')
            ->orderBy('id','DESC') // Упорядочить по ID
            ->paginate(16); // Пагинация на 16
        return view('public.book-page', compact('books', 'categoryName')); // Возврат представления
    }
    
    /*
     * Фильтрация книг по автору
     */
    public function author(Author $author) // Автор
    {
        $authorName = $author->name; // Имя автора
        $books = $author->books() // Книги автора
            ->with('category', 'author', 'image')
            ->orderBy('id', 'DESC') // Упорядочить по ID
            ->paginate(12); // Пагинация на 12
        return view('public.book-page', compact('books', 'authorName')); // Возврат представления
    }

    public function bookDetails($id) // Подробности о книге
    {
        $book = Book::findOrFail($id); // Найти книгу
        $book_reviews = $book->reviews()->latest()->get(); // Получить отзывы
        return view('public.book-details' , compact('book', 'book_reviews')); // Возврат представления
    }
}
