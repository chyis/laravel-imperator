<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleContent;
use App\Models\Category;
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
            ->paginate(config('admin.tools.perPage'));

        return view('admin.news.index')
            ->with('lists', $list)
            ->with('pageName', '内容管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     * GET /news/create
     *
     * @return Response
     */

    public function create()
    {
        $category = Category::dirRoot();

        return view('admin.news.create')
            ->with('pageName', '文档添加')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     * POST /news
     *
     * @return Response
     */

    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->summary = $request->input('summary');
        $article->cate_id = $request->input('cate_id');
        $article->tags = $request->input('tags');
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
     * @return Response
     */

    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     * GET /news/{id}/edit
     *
     * @param int $id
     * @return Response
     */

    public function edit(int $id)
    {
        $category = Category::dirRoot();
        $article = Article::find($id);

        return view('admin.news.edit')
            ->with('pageName', '文档添加')
            ->with('entity', $article)
            ->with('gallery', [])
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     * PUT /news/{id}
     *
     * @param int $id
     * @return Response
     */

    public function update(ArticleRequest $request, int $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->summary = $request->input('summary');
        $article->cate_id = $request->input('cate_id');
        $article->tags = $request->input('tags');
        $article->sort = intval($request->input('sort'));
        $article->status = intval($request->input('status'));

        if ($res = $article->save())
        {
            $content =  ArticleContent::find($id);
            $content->content = $request->input('content');;
//            $content->create_user = 1;
            $content->last_modify_user = 2;
            $content->save();

            return $this->success('修改成功');
        } else {
            return $this->errot('新增失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /news/{id}
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $article = Article::findOrfail($id);
        if ($article)
        {
            $article->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }

}
