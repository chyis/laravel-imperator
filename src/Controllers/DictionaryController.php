<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Requests\DictionaryRequest;
use Chyis\Imperator\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DictionaryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $searchField = $request->input('search_field');
        $condition = [];

        if ($keyWord != '' && $searchField == 'name')
        {
            $condition[] = ['var_name', $keyWord];
        } else if ($keyWord != '' && $searchField == 'code') {
            $condition[] = ['var_code', $keyWord];
        }
        $query = Dictionary::orderBy('parent_id', 'asc')
            ->orderBy('sort', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        return view('Imperator::dictionary.index')
            ->with('lists', $list)
            ->with('pageName', '字典管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuRoot = Dictionary::where('parent_id', 0)
            ->get();
        return view('Imperator::dictionary.create')
            ->with('pageName', '字典添加')
            ->with('parents', $menuRoot);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DictionaryRequest $request)
    {
        $dict = new Dictionary();
        $dict->var_name = $request->input('var_name');
        $dict->parent_id = intval($request->input('parent_id'));
        $dict->var_code = $request->input('var_code') == '' ? '' : $request->input('var_code');
        $dict->var_value = $request->input('var_value') == '' ? '' : $request->input('var_value');
        $dict->sort = intval($request->input('sort'));
        if ($request->input('parent_id') > 0)
        {
            $parent = Dictionary::find($request->input('parent_id'));
            $dict->var_code = $parent->var_code;
            $dict->type = 1; //子分支【理论上可以根据上级type+1】
            if ($dict->var_value == '')
            {
                return $this->error("非独立字典必须填写字典值");
            }
            if ($dict->sort == 0)
            {
                return $this->error("非独立字典必须填写排序");
            }
        } else {
            $dict->type = 0; //根
            if ($dict->var_code == '')
            {
                return $this->error("独立字典必须填写字典标识");
            }
        }

        $dict->create_uid = 1;
        $dict->last_uid = 1;
        $res = $dict->saveOrFail();
        if ($res)
        {
            return $this->success('保存成功', 0, '');
        } else {
            return $this->error('失败', 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(int $dictionary)
    {
        //return $dictionary;
        $dictionary = Dictionary::findOrFail($dictionary);
        $menuRoot = Dictionary::where('parent_id', 0)
            ->get();
        if ($dictionary)
        {
            return view('Imperator::dictionary.edit')
                ->with('parents', $menuRoot)
                ->with('pageName', '字典修改')
                ->with('entity', $dictionary);
        } else {
            return $this->error('没找到');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(int $dictionary, DictionaryRequest $request)
    {
        $dict = Dictionary::findOrFail($dictionary);

        $dict->var_name = $request->input('var_name');
        $dict->parent_id = intval($request->input('parent_id'));
        $dict->var_code = $request->input('var_code') == '' ? '' : $request->input('var_code');
        $dict->var_value = $request->input('var_value') == '' ? '' : $request->input('var_value');
        $dict->sort = intval($request->input('sort'));

        if ($request->input('parent_id') > 0)
        {
            $parent = Dictionary::find($request->input('parent_id'));
            $dict->var_code = $parent->var_code;
            $dict->type = 1; //子分支【理论上可以根据上级type+1】
            $dict->var_value = $request->input('var_value');
            if ($dict->var_value == '')
            {
                return $this->error("非独立字典必须填写字典值");
            }
            if ($dict->sort == 0)
            {
                return $this->error("非独立字典必须填写排序");
            }
        } else {
            $dict->type = 0; //根
            $dict->var_value = '';
            if ($dict->var_code == '')
            {
                return $this->error("独立字典必须填写字典标识");
            }
        }
        $dict->last_uid = 2;

        $res = $dict->saveOrFail();
        if ($res)
        {
            return $this->success('修改成功');
        } else {
            return $this->error('修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $dictionary)
    {
        $dictionary = Dictionary::findOrfail($dictionary);
        if ($dictionary)
        {
            $dictionary->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
