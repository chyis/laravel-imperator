<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\PrivilegeRequest;
use App\Models\Privilege;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class PrivilegeController extends AdminController
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
            $condition[] = ['name', $keyWord];
        } else if ($keyWord != '' && $searchField == 'group') {
            $condition[] = ['group_id', $keyWord];
        }
        $query = Privilege::orderBy('group_id', 'asc')
            ->orderBy('id', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        return view('admin.privilege.index')
            ->with('lists', $list)
            ->with('pageName', '权限管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prigroup = Dictionary::where('var_code', 'prigroup')
            ->where('parent_id', '>', 0)
            ->get();
        return view('admin.privilege.create')
            ->with('pageName', '权限添加')
            ->with('parents', $prigroup);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PrivilegeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivilegeRequest $request)
    {
        if ($request->input('http_method') == 'source')
        {
            $sources = Privilege::$sourceMethod;
            foreach ($sources as $action)
            {
                $data = Privilege::makeSourceData($request->input('name'), $request->input('http_path'), $request->input('code'),  $action);
                $data['group_id'] = intval($request->input('group_id'));
                $res = Privilege::create($data);
            }
            if ($res)
            {
                return $this->success('批量生成权限成功', 0, '');
            } else {
                return $this->error('失败', 1);
            }
        } else {
            $priv = new Privilege();
            $priv->name = $request->input('name');
            $priv->group_id = intval($request->input('group_id'));
            $priv->code = $request->input('code') == '' ? '' : $request->input('code');
            $priv->http_method = $request->input('http_method') == '' ? '' : $request->input('http_method');
            $priv->http_path = $request->input('http_path') == '' ? '' : $request->input('http_path');
            $res = $priv->saveOrFail();
            if ($res)
            {
                return $this->success('保存成功', 0, '');
            } else {
                return $this->error('失败', 1);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege)
    {
        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(int $privilege)
    {
        //return $dictionary;
        $privilege = Privilege::findOrFail($privilege);
        $prigroup = Dictionary::where('var_code', 'prigroup')
            ->where('parent_id', '>', 0)
            ->get();

        if ($privilege)
        {
            return view('admin.privilege.edit')
                ->with('parents', $prigroup)
                ->with('pageName', '权限修改')
                ->with('entity', $privilege);
        } else {
            return $this->error('没找到');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(int $privilege, PrivilegeRequest $request)
    {
        $priv = Privilege::findOrFail($privilege);

        $priv->name = $request->input('name');
        $priv->group_id = intval($request->input('group_id'));
        $priv->code = $request->input('code') == '' ? '' : $request->input('code');
        $priv->http_method = $request->input('http_method') == '' ? '' : $request->input('http_method');
        $priv->http_path = $request->input('http_path') == '' ? '' : $request->input('http_path');

        $res = $priv->saveOrFail();
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
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $privilege)
    {
        $privilege = Dictionary::findOrfail($privilege);
        if ($privilege)
        {
            $privilege->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }

}
