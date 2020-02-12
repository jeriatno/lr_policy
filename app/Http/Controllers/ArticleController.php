<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
    // show
    public function index(Article $article)
    {
        $data = $article->all();

        $response = fractal()
                    ->collection($data)
                    ->transformWith(new ArticleTransformer)
                    ->toArray();

        return response()->json($response, 200);
    }

    // save
    public function store(Request $request, Article $article)
    {
        $this->validate($request, [
            'content'   => 'required|min:5'
        ]);

        $data = $article->create([
                    'user_id'   => Auth::id(),
                    'content'   => $request->content
                ]);

        $response = fractal()
                    ->item($data)
                    ->transformWith(new ArticleTransformer)
                    ->toArray();

        return response()->json($response, 201);
    }

    // update
    public function update(Request $request, Article $article)
    {
        // policy update
        $this->authorize('update', $article);

        $article->content = $request->get('content', $article->content);
        $article->save();

        return fractal()
                ->item($article)
                ->transformWith(new ArticleTransformer)
                ->toArray();
    }

    // delete
    public function destroy(Article $article)
    {
        // policy delete
        $this->authorize('delete', $article);

        $article->delete();

        return response()->json([
            'message'   => "Article deleted!"
        ]);
    }
}
