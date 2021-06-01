<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Наименование BlogCategoryRepository составлено из 
 *  имени модели BlogCategory и указания на Репозиторий
 */
class BlogCategoryRepository extends CoreRepository
{
    /** 
     * Реализация абстрактного метода из CoreRepository .
     * Model - это сокращение, здесь для BlogCategory .
     * @return string
     */
    protected function getModelClass()
    {       
        return Model::class;
    }


    /**
     * Получить модель для редактирования в админке.
     * Можно настроить получение только нужных полей. 
     * @param int $id
     *
     * @return model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке.
     * 
     * @return Collection
     * 
     */

    public function getForComboBox()
    {
        return $this->startConditions()->all();

    }

    
}