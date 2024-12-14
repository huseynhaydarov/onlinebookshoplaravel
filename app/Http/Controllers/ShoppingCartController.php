<?php

namespace App\Http\Controllers;

use App\Book;
use Cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        if ($book->quantity >= $request->quantity){

            if ($request->quantity >= 1)
            {
                $cartItem = Cart::add([
                    'id' => $book->id,
                    'name' => $book->title,
                    'price' => $book->price,
                    'qty' => $request->quantity,
                    'weight' => 0,
                    'options' => [
                        'image' => $book->image
                    ]
                ]);
                return redirect()->back();
            }
            else
                {
                return redirect()->back()
                    ->with('cart_alert', "Количество должно быть больше 0");
                }

        }
        else {
            return redirect()->back()
                ->with('cart_alert', "У нас нет такого количества в наличии.");
        }

    }

    public function cart()
    {
        return view('public.cart');
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function cart_increment($id, $qty, $book_id)
    {
        $book = Book::findOrFail($book_id);

        if($book->quantity > $qty)
        {
            Cart::update($id, $qty+1);
            return redirect()->back();
        }
        else
        {
            return redirect()->back()
                ->with('cart_alert', "Нет больше доступного количества этого товара на складе");
        }

    }

    public function cart_decrement($id, $qty)
    {
        Cart::update($id, $qty-1);
        return redirect()->back();
    }
}
