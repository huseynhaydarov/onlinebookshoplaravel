<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;

class AdminAuthorsController extends Controller
{
    /**
     * Отображение списка ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('image')->orderBy('id', 'DESC')->get();
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Показ формы для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Сохранение нового ресурса в базе данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:authors',
            'bio'  => 'required',
            'image_id'=> 'image|max:500'
        ];
        $message = [
            'image_id.image' => 'Изображение должно быть в формате PNG, JPG или JPEG.'
        ];
        $this->validate($request, $rules, $message);

        $input = $request->all();
        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(150,150);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $create_author = Author::create($input);
        return redirect('/admin/authors')
            ->with('success_message', 'Автор успешно создан');
    }

    /**
     * Отображение указанного ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Показ формы для редактирования указанного ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.author.edit', compact('author'));
    }

    /**
     * Обновление указанного ресурса в базе данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:authors,slug,'.$id,
            'bio'  => 'required',
            'image_id'=> 'image|max:500'
        ];
        $message = [
            'image_id.image' => 'Изображение должно быть в формате PNG, JPG или JPEG.'
        ];
        $this->validate($request, $rules, $message);

        $input = $request->all();
        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(150,150);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $author = Author::findOrFail($id);
        $author->update($input);
        return redirect('/admin/authors')
            ->with('success_message', 'Автор успешно обновлен');
    }

    /**
     * Удаление указанного ресурса из базы данных.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        if(! is_null($author->image_id))
        {
            unlink(public_path().'/assets/img/'.$author->image->file);
        }
        $author->image()->delete();
        $author->books()->delete();
        $author->delete();

        return redirect()->back()
            ->with('alert_message', "Автор успешно удален.");
    }
}
