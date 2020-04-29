<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Requests\SettingRequest;
use Chyis\Imperator\Models\Dictionary;
use Chyis\Imperator\Models\Setting;
use Chyis\Imperator\Models\Attributes;
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
        $query = Setting::orderBy('group_id', 'asc');
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::config.index')
            ->with('lists', $list)
            ->with('pageName', '配置项管理');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Dictionary::getType('setting');
        $inputTypes = Attributes::getInputTypes();

        return view('Imperator::config.create')
            ->with('pageName', '配置项添加')
            ->with('inputTypes', $inputTypes)
            ->with('types', $types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $setting = new Setting();
        $setting->title = $request->input('title');
        $setting->group_id = $request->input('group_id');
        $setting->input_type = $request->input('input_type');
        $setting->order = intval($request->input('order'));
        $setting->validate = $request->input('validate') ?? '';
        $setting->default_value = $request->input('default_value') ?? '';
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
        $types = Dictionary::getType('setting');
        $inputTypes = Attributes::getInputTypes();

//        $attributes = Category::findOrFail($attributes);
        if ($config)
        {
            return view('Imperator::config.edit')
                ->with('pageName', '配置项修改')
                ->with('inputTypes', $inputTypes)
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
//        $setting = Setting::findOrFail($config);

        $config->title = $request->input('title');
        $config->group_id = $request->input('group_id');
        $config->input_type = $request->input('input_type');
        $config->data_source = $request->input('data_source') ?? '';
        $config->validate = $request->input('validate') ?? '';
        $config->default_value = $request->input('default_value') ?? '';
        $config->order = intval($request->input('order'));
        $res = $config->saveOrFail();
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
