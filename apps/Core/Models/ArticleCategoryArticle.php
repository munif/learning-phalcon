<?php

namespace App\Core\Models;

class ArticleCategoryArticle extends Base
{
    public function initialize()
    {
        $this->belongsTo(
            'category_id',
            'App\Core\Models\Category',
            'id',
            array('alias' => 'category')
        );
        $this->belongsTo(
            'article_id',
            'App\Core\Models\Article',
            'id',
            array('alias' => 'article')
        );
    }
}
