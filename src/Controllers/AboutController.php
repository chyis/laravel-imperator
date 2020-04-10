<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends AdminController
{
    /*
     * @name: edit
     * 信息修改页面
     * @param:
     * @return:
     */
    public function edit()
    {
        $setting = Setting::getCode();

        return view('Imperator::about.edit')
            ->with('setting', $setting);
    }

    /*
     * @name: update
     * 信息保存程序
     * @param:
     * @return:
     */
    public function update(Request $request)
    {
        $setting  = $request->input('setting');
        $group_id = $request->input('group_id');

        Setting::saveAll($setting, $group_id);

        return $this->success('修改成功');
    }
}
