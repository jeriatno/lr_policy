<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function users(User $user)
    {
        $users = $user->all();

        return fractal()
                ->collection($users)
                ->transformWith(new UserTransformer)
                ->toArray();
    }

    public function profile(User $user)
    {
        $data = $user->find(Auth::id());

        return fractal()
                ->item($data)
                ->transformWith(new UserTransformer)
                ->includeArticles()
                ->toArray();
    }

    public function show(User $user, $id)
    {
        $data = $user->find($id);

        return fractal()
                ->item($data)
                ->transformWith(new UserTransformer)
                ->includeArticles()
                ->toArray();
    }
}
