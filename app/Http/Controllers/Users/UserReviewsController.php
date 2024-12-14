<?php

namespace App\Http\Controllers\Users;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReviewsController extends UsersBaseController
{
    public function myReviews() // Мои отзывы
    {
        $userId = Auth::user()->id; // Получение идентификатора пользователя
        $myReviews = Review::where('user_id', $userId)->latest()->paginate(10); // Получение отзывов пользователя с пагинацией
        return view('public.users.reviews', compact('myReviews')); // Возврат представления с отзывами
    }

    public function deleteReview($id) // Удалить отзыв
    {
        $review = Review::findOrFail($id); // Получение отзыва по идентификатору
        $review->delete(); // Удаление отзыва

        return redirect()->back()->with('alert_message', 'Ваш отзыв удален'); // Перенаправление с сообщением об удалении
    }
}
