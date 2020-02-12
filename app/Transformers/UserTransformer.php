<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\ArticleTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'articles'
    ];
    // api output
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'join_at'   => $user->created_at->diffForHumans(),
        ];
    }

    // user've articles
    public function includeArticles(User $user)
    {
        $articles = $user->articles()->desc()->get();
        return $this->collection($articles, new ArticleTransformer);
    }
}
