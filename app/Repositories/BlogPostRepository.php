<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

/**
 * Class BlogPostRepository.
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

     /**
     * Получить список статей для вывода в списке
     * (Админка)
     *
     * @return LengthAwarePaginator
     */

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',  // T/F
            'published_at',  // Null / или дата
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()  // создаётся новый экземпляр класса BlogPost
            ->select($columns)              // выбранные колонки
            ->orderBy('id', 'DESC')         // сортировка по убыванию по айди
            /*
            //->with(['category', 'user'])  // жадная загрузка
            ->with([
                    'category' => function ($query) {
                    $query->select(['id','title']);
                    },
                    'user:id,name'
                  ])
            */
            ->paginate(25);
        
        //dd($result);

        return $result;
    }


}