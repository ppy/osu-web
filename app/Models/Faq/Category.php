<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "faq_categories";

    protected $fillable = ["title"];

    public function articles()
    {
    	return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
