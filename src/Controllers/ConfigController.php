<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Requests\SettingRequest;
use Chyis\Imperator\Models\Dictionary;
use Chyis\Imperator\Models\Setting;
use Illuminate\Http\Request;


class ConfigController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Setting::orderBy('id', 'desc');
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::config.index')
            ->with('lists', $list)
            ->with('pageName', '内容属性管理');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Dictionary::ContentType()->get();

        return view('Imperator::config.create')
            ->with('pageName', '栏目添加')
            ->with('types', $types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->cate_name = $request->input('cate_name');
        $setting->parent_id = $request->input('parent_id');
        $setting->type_id = $request->input('type_id');
        $setting->sort = $request->input('sort');
        $setting->image = $request->input('image') ?? '';
        $setting->create_uid = 1;
        $res = $setting->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        }

        return $this->error('失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Setting  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $config)
    {
        //
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\setting  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $config)
    {
        $types = Dictionary::ContentType()->get();

//        $attributes = Category::findOrFail($attributes);
        if ($config)
        {
            return view('Imperator::config.edit')
                ->with('pageName', '栏目修改')
                ->with('types', $types)
                ->with('entity', $config);
        } else {

            return $this->error('没找到');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chyis\Imperator\Models\Setting  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $config)
    {
        $setting = Attributes::findOrFail($config);

        $setting->cate_name = $request->input('cate_name');
        $setting->parent_id = $request->input('parent_id');
        $setting->type_id = $request->input('type_id');
        $setting->sort = $request->input('sort');
        $setting->image = $request->input('image') ?? '';
        $res = $setting->saveOrFail();
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
     * @param  int  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $config)
    {
        $config = Attributes::findOrFail($config);
        if ($config->id >0 )
        {
            $config->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
