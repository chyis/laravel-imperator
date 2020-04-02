<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Requests\ModuleRequest;
use Illuminate\Http\Request;
use Chyis\Imperator\Models\Dictionary;
use Chyis\Imperator\Models\Module;

class ModuleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
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
        $query = Module::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));
        $pages = Dictionary::pageType()->get();

        return view('Imperator::module.index')
            ->with('pageName', '页面模块管理')
            ->with('lists', $list)
            ->with('pages', $pages)
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Dictionary::pageType()->get();

        return view('Imperator::module.create')
            ->with('pages', $pages)
            ->with('pageName', '页面模块添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\ModuleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        $module = new Module();
        $pageID = intval($request->input('page_id'));
        $page = Dictionary::find($pageID);
        $data['title'] = $request->input('title');
        $data['page_id']  = $pageID;
        $data['page_code']  = $page->var_value;
        $data['type']  = $request->input('type');
        $data['content']  = $request->input('content');
        $data['length'] = intval($request->input('length'));
        $res = $module->create($data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        $pages = Dictionary::pageType()->get();

        return view('Imperator::module.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $pages = Dictionary::pageType()->get();

        return view('Imperator::module.edit')
            ->with('pageName', '页面模块修改')
            ->with('entity', $module)
            ->with('pages', $pages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\ModuleRequest $request
     * @param  \Chyis\Imperator\Models\Module  $module
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $pageID = intval($request->input('page_id'));
        $page = Dictionary::find($pageID);
        $data['title'] = $request->input('title');
        $data['page_id']  = $pageID;
        $data['page_code']  = $page->var_value;
        $data['type']  = $request->input('type');
        $data['content']  = $request->input('content');
        $data['length'] = $request->input('length');
        $res = $module->update($data);
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
     * @param  \Chyis\Imperator\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        if ($module)
        {
            $module->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
