<?php

namespace App\Http\Controllers\Users;

use App\Order; // Заказ
use App\OrderDetail; // Подробности заказа
use Illuminate\Http\Request; // Запрос
use App\Http\Controllers\Controller; // Контроллер
use Illuminate\Support\Facades\Auth; // Аутентификация

class UserOrdersController extends UsersBaseController
{
    public function myOrders() // Мои заказы
    {
        $userId = Auth::user()->id; // Получение идентификатора пользователя
        $myOrders = Order::where('user_id', $userId)->latest()->get(); // Получение заказов пользователя
        return view('public.users.orders', compact('myOrders')); // Возврат представления с заказами
    }
    
    public function order_details($id) // Подробности заказа
    {
        $order = Order::findOrFail($id); // Получение заказа по идентификатору
        $order_details = OrderDetail::where('order_id', $id)->get(); // Получение подробностей заказа

        return view('public.users.order-details', compact('order_details', 'order')); // Возврат представления с подробностями заказа
    }
}
