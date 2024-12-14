<?php

namespace App\Http\Requests;

use App\Book;
use Illuminate\Foundation\Http\FormRequest;

class BooksUpdateRequest extends FormRequest
{
    /**
     * Определяет, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Получить правила валидации, применимые к запросу.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'slug'          => 'required|unique:books,slug,'.$this->book,
            'description'   => 'required',
            'author_id'     => 'required',
            'category_id'   => 'required',
            'image_id'      => 'image|max:1000',
            'init_price'    => 'required|numeric',
            'discount_rate' => 'required|numeric|max:100',
            'quantity'      => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'author_id.required'    => 'Поле автора обязательно',
            'category_id.required'  => 'Поле категории обязательно',
            'image_id.image'        => 'Тип изо
