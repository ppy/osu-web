<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'faq_articles';
    protected $fillable = [
        'title',
        'category_id',
        'content',
    ];
}
