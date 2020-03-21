<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;


class SettingController extends AdminController
{

    public function index()
    {
        $setting = Setting::getCode();

        return view('admin.setting.base')
            ->with('setting', $setting);
    }

    public function system()
    {
        $setting = Setting::getCode();

        return view('admin.setting.system')
            ->with('setting', $setting);
    }

    public function upload()
    {
        $setting = Setting::getCode();

        return view('admin.setting.upload')
            ->with('setting', $setting);
    }

    public function store(Request $request)
    {
        $setting  = $request->input('setting');
        $group_id = $request->input('group_id');

        Setting::addAll($setting, $group_id);

        return $this->success('添加成功');
    }

    public function update(Request $request)
    {
        $setting  = $request->input('setting');
        $group_id = $request->input('group_id');

        Setting::saveAll($setting, $group_id);

        return $this->success('修改成功');
    }
}
