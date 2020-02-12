<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    // api output
    public function transform(Article $article)
    {
        return [
            'id'          => $article->id,
            'user'        => $article->user_id,
            'content'     => $article->content,
            'published'   => $article->created_at->diffForHumans(),
        ];
    }
}
