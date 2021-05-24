<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Blog\Admin\BaseController;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // проверка
        //dd(__METHOD__);

        //$d2 = BlogCategory::all();
        $paginator = BlogCategory::paginate(5);
        //dd($d2, $paginator); //информация о переменных

        return view('blog.admin.categories.index', compact('paginator'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // проверка
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show не будет работать, 
        // если он не задан в routes/wep.php
        // проверка
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // проверка
        //dd(__METHOD__);

        //$item[] = BlogCategory::find($id);  // return this element or null        
        //$item[] = BlogCategory::where('id', '=', $id)->first(); // return this element
        // dd(collect($item)->pluck('id'));  // покажет id для каждого item

        $item = BlogCategory::findOrFail($id); // return this element or 404
       
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  
                // request и id приходит с формы редактирования.
                // $request - это объект Request'a, работает с входящими данными.
                // $id ($name и т.п.) без указания, чей id, обозначает отношение к текущему контроллеру,
                // т.е. к категории
    {
        // проверка
        //dd(__METHOD__, $request->all(), $id);       
        //$id = 102102102;

        $item = BlogCategory::find($id); // find вернёт элемент или null

        // можно подставить выше несуществующий $id = 102102102; 
        // и запустить для проверки получения ошибки
        // или вывести dd($item) для проверки получения null

        if(empty($item)){               // если empty, в т.ч. null,
            return back()               // back (из хелперов) редиректит на шаг назад (назад по url)
                ->withErrors(['msg' => "Запись id=[{$id}]не найдена"]) // сохраняет ошибку в сессию и выводит её
                ->withInput();          // возвращает на место уже заполненные данные с input полей,
                ;                        // это _old_input в дебагбаре, в Session
        }

        $data = $request->all();  // массив всех данных, полученных реквестом
                                  // можно использовать $request->input();
        $result = $item
            ->fill($data) // перезаписывает свойства объекта $item
            ->save();     // cохраняет свойства в БД, вернёт true/false

        // следует реакция на сохранение: goodway/badway
        if ($result){
            return redirect() // redirect из хелперов
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success'=> 'Успешно сохранено']);    // уходит в сессию
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])  // уходит в сессию
                ->withInput();
        }

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
