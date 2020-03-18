<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Dictionary;
use App\Http\Requests\LinkRequest;

class LinksController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['title', $keyWord];
        }
        $query = Link::orderBy('sort', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        return view('admin.link.index')
            ->with('pageName', '合作伙伴管理')
            ->with('lists', $list)
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Dictionary::partnerType()->get();

        return view('admin.link.create')
            ->with('types', $types)
            ->with('pageName', '合作伙伴添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $link = new Link();
        $link->title = $request->input('title');
        $link->uri = $request->input('uri');
        $link->cate_id = $request->input('cate_id');
        $link->description = $request->input('description');
        $link->sort = $request->input('sort');
        $link->icon = '';
        $res = $link->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $link)
    {

        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $link = Link::find($id);
        $types = Dictionary::partnerType()->get();

        return view('admin.link.edit')
            ->with('pageName', '合作伙伴修改')
            ->with('entity', $link)
            ->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, int $link)
    {
        $link = Link::find($link);
        $link->title = $request->input('title');
        $link->uri = $request->input('uri');
        $link->cate_id = $request->input('cate_id');
        $link->description = $request->input('description');
        $link->sort = $request->input('sort');
        $link->icon = '';
        $res = $link->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $link)
    {
        $link = Link::findOrfail($link);
        if ($link)
        {
            $link->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
