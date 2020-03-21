<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\MenuRequest;
use App\Models\Dictionary;
use App\Models\Menu;
use App\Models\Privilege;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MenuController extends AdminController
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
        $query = Menu::orderBy('parent_id', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->orderby('order', 'asc')
            ->paginate(config('admin.tools.perPage'));

        return view('admin.menu.index')
            ->with('pageName', '菜单管理')
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
        $parents = Menu::root()->get();
        $types = Dictionary::menuType()->get();
        $pos = Dictionary::posType()->get();
        $priUnits = Dictionary::privType()->get();

        return view('admin.menu.create')
            ->with('parents', $parents)
            ->with('types', $types)
            ->with('pos', $pos)
            ->with('privileges', $priUnits)
            ->with('pageName', '菜单添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = new Menu();
        $menu->title = $request->input('title');
        $menu->uri = $request->input('url');
        $menu->parent_id = $request->input('parent_id');
        $menu->type_id = $request->input('type_id');
        $menu->position = $request->input('pos');
        $menu->order = $request->input('order');
        $menu->privilege_id = intval($request->input('priv_id'));
        $menu->icon = '';
        $res = $menu->saveOrFail();
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {

        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $parents = Menu::root()->get();
        $types = Dictionary::menuType()->get();
        $pos = Dictionary::posType()->get();
        $priUnits = Dictionary::privType()->get();

        return view('admin.menu.edit')
            ->with('pageName', '菜单修改')
            ->with('entity', $menu)
            ->with('parents', $parents)
            ->with('types', $types)
            ->with('positions', $pos)
            ->with('privileges', $priUnits);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, int $menu)
    {
        $menu = Menu::find($menu);
        $menu->title = $request->input('title');
        $menu->uri = $request->input('url');
        $menu->parent_id = $request->input('parent_id');
        $menu->type_id = $request->input('type_id');
        $menu->position = $request->input('pos');
        $menu->order = $request->input('order');
        $menu->privilege_id = intval($request->input('priv_id'));
        $menu->icon = '';
        $res = $menu->saveOrFail();
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
    public function destroy(int $menu)
    {
        $menu = Menu::findOrfail($menu);
        if ($menu)
        {
            $menu->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
