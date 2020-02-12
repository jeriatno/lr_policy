<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Article $article)
    {
        return $user->ownsArticle($article);
    }

    public function delete(User $user, Article $article)
    {
        return $user->ownsArticle($article);
    }
}
