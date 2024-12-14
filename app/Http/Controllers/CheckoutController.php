<?php

namespace App\Http\Controllers;

use App\Book; // Книга
use App\Http\Requests\ShippingAddressRequest; // Запрос адреса доставки
use App\Order; // Заказ
use App\OrderDetail; // Подробности заказа
use App\ShippingAddress; // Адрес доставки
use Illuminate\Http\Request; // Запрос
use Illuminate\Support\Facades\Auth; // Аутентификация
use Stripe\Charge; // Платежи
use Stripe\Stripe; // Stripe API
use Cart; // Корзина

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Миддлвар для аутентификации
    }

    /**
     * Отображение списка ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::content()->count()) {
            return view('public.checkout-page'); // Возврат представления страницы оформления заказа
        }
        abort(403, 'Корзина пуста! Вы не можете оформить заказ'); // Ошибка, если корзина пуста
    }

    public function pay(Request $request) // Метод для обработки платежа
    {
        Stripe::setApiKey('sk_test_2DCNbttQJFTfjupPjhseb3mc00Jm3oE7L6'); // Установка ключа API Stripe
        $token = $request->stripeToken; // Токен Stripe
        $total = $request->cart_total; // Общая сумма

        $charge = Charge::create([ // Создание платежа
            'amount' => $total * 100, // Сумма в копейках
            'currency' => 'BDT', // Валюта
            'description' => 'Оплата книг', // Описание
            'source' => $token, // Источник платежа
        ]);

        $order = new Order(); // Новый заказ
        $user = Auth::user(); // Получение текущего пользователя

        $shipping_address = ShippingAddress::where('user_id', $user->id)->latest()->first(); // Получение последнего адреса доставки

        // Заполнение данных заказа
        $order->user_id = $user->id;
        $order->shipping_id = $shipping_address->id;
        $order->total_price = $total;
        $order->payment_type = 'card';

        $order->save(); // Сохранение заказа

        $order_id = $order->id; // ID заказа

        foreach (Cart::content() as $cartItem) // Проход по элементам корзины
        {
            $orderDetails = new OrderDetail(); // Новые подробности заказа

            // Заполнение данных о книге
            $orderDetails->order_id = $order_id;
            $orderDetails->book_id = $cartItem->id;
            $orderDetails->book_name = $cartItem->name;
            $orderDetails->price = $cartItem->price;
            $orderDetails->book_quantity = $cartItem->qty;

            $orderDetails->save(); // Сохранение деталей заказа

            Cart::remove($cartItem->rowId); // Удаление элемента из корзины

            $remove_product = Book::findOrFail($orderDetails->book_id); // Поиск книги

            // Обновление количества книги
            $remove_product->update([
                'quantity' => $remove_product->quantity - $orderDetails->book_quantity,
            ]);
        }

        return redirect()->route('user.orders')
            ->with('success_message', 'Заказ успешно оформлен. Ожидайте подтверждения.'); // Перенаправление с сообщением об успехе
    }

    /**
     * Показать форму для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Сохранить новый ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingAddressRequest $request)
    {
        $input = $request->all(); // Получение всех данных запроса
        $input['user_id'] = Auth::user()->id; // Добавление ID пользователя

        $shipping = ShippingAddress::create($input); // Создание адреса доставки

        return redirect()->route('cart.payment'); // Перенаправление на страницу оплаты
    }

    /**
     * Отобразить указанный ресурс.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('public.payment'); // Возврат представления страницы оплаты
    }

    /**
     * Показать форму для редактирования указанного ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Обновить указанный ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Удалить указанный ресурс из хранилища.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
