<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::all();

        $status = true;
        $message = 'Data berhasil diambil !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = [
            'title' => 'required',
            'content' => 'required',
        ];

        $request->validate($validateData);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        $id = Article::create($data)->id;
        $data = Article::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil dibuat !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validateData = [
            'article_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];

        $request->validate($validateData);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        Article::find($article->id)->update($data);
        $data = Article::firstWhere('id', $article->id);

        $status = true;
        $message = 'Data berhasil diubah !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::find($article->id)->delete();

        $status = true;
        $message = 'Data berhasil dihapus !';

        $response = [
            'status' => $status,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
