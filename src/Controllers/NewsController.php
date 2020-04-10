<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Tags;
use Chyis\Imperator\Requests\ArticleRequest;
use Chyis\Imperator\Models\Article;
use Chyis\Imperator\Models\ArticleContent;
use Chyis\Imperator\Models\Category;
use Illuminate\Http\Request;

class NewsController extends AdminController
{

    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['title', $keyWord];
        }
        $query = Article::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::news.index')
            ->with('lists', $list)
            ->with('pageName', '内容管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     * GET /news/create
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Category::dirRoot();

        return view('Imperator::news.create')
            ->with('pageName', '文档添加')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     * POST /news
     * @param \Chyis\Imperator\Requests\ArticleRequest $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->summary = $request->input('summary');
        $article->cate_id = $request->input('cate_id');
        $article->tags = $request->input('tags');
        $article->image = $request->input('image') ?? '';
        $article->sort = intval($request->input('sort'));
        $article->status = intval($request->input('status'));

        if ($res = $article->save())
        {
            $id = $article->id;
            if ($id>0)
            {
                $content = new ArticleContent();
                $content->article_id = $id;
                $content->content = $request->input('content');;
                $content->create_user = 1;
//                $content->last_modify_user = $id;
                $content->save();
                $tag = new Tags();
                $tag->saveTags(explode(',', $request->input('tags')), $id, 'article');
            }
            return $this->success('成功');
        } else {
            return $this->errot('新增失败');
        }
    }


    /**
     * Display the specified resource.
     * GET /news/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return view('Imperator::news.preview');
    }


    /**
     * Show the form for editing the specified resource.
     * GET /news/{id}/edit
     *
     * @param \Chyis\Imperator\Models\Article $news
     * @return \Illuminate\Http\Response
     */

    public function edit(Article $news)
    {
        $category = Category::dirRoot();

        return view('Imperator::news.edit')
            ->with('pageName', '文档修改')
            ->with('entity', $news)
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     * PUT /news/{id}
     * @param \Chyis\Imperator\Requests\ArticleRequest $request
     * @param \Chyis\Imperator\Models\Article $news
     *
     * @return \Illuminate\Http\Response
     */

    public function update(ArticleRequest $request, Article $news)
    {
        $news->title = $request->input('title');
        $news->summary = $request->input('summary');
        $news->cate_id = $request->input('cate_id');
        $news->tags = $request->input('tags');
        $news->image = $request->input('image') ?? '';
        $news->sort = intval($request->input('sort'));
        $news->status = intval($request->input('status'));

        if ($res = $news->save())
        {
            $content =  ArticleContent::find($news->id);
            $content->content = $request->input('content');;
//            $content->create_user = 1;
            $content->last_modify_user = 2;
            $content->save();
            $tag = new Tags();
            $tag->saveTags(explode(',', $request->input('tags')), $news->id, 'article');

            return $this->success('修改成功');
        } else {
            return $this->errot('新增失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /news/{id}
     * @param \Chyis\Imperator\Models\Article $news
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy(Article $news)
    {
        if ($news) {
            $news->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }

}
