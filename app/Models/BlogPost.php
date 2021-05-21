<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;
    // SoftDeletes меняет запросы вида select *всё from на
    // select * from `blog_posts` where `blog_posts`.`deleted_at` is null,
    // т.е. удаленные остаются в базе данных, но не участвуют в выборке.
    // В этом случае запрос типа "with trashed" выдаст и удалённые тоже.
    // Т.е. используется $items = BlogPost::withTrashed()->all();
    // вместо $items = BlogPost::all();
}
