<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'image_id', 'is_active'];

    /**
     * Атрибуты, которые следует скрыть в массивах.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Атрибуты, которые следует преобразовать в нативные типы.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /*
    * Геттер для получения URL изображения
    */
    public function getImageUrlAttribute($value)
    {
        return asset('/').'assets/img/'.$this->image->file;
    }
    
    public function getDefaultImgAttribute($value)
    {
        return asset('/').'assets/img/'.'user-placeholder 3.png';
    }

    /*
     * Проверка, является ли пользователь администратором
     */
    public function isAdmin()
    {
        if($this->role->name == 'Admin' && $this->is_active == 1)
        {
            return true;
        }
        return false;
    }

    /*
     * Проверка, является ли пользователь обычным пользователем
     */
    public function isUser()
    {
        if ($this->role->name == 'User')
        {
            return true;
        }
        return false;
    }
}
