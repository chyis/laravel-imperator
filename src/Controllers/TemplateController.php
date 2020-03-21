<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class TemplateController extends AdminController
{

    /**
     * @name: index
     * 展示当前系统存在的模板
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $views = $this->readViews();

        return view('admin.template.index')
            ->with('template', $views);
    }

    /**
     * @name: update
     * 修改模板信息
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tplName = $request->input('name');
        $code = $request->input('code');
        $screenShot = $request->input('screen');
        $jsonData = [];
        $jsonData['name'] = $tplName;
        $jsonData['screenShot'] = $screenShot;

        $this->updateTpl($code, $jsonData);

        return $this->success('更新成功');
    }

    /**
     * @name: setDefault
     * 设置模板为使用模板
     *
     * @param Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function setDefault(Request $request)
    {
        $code = $request->input('code');

        return $this->success('更新成功');
    }

    /**
     * @name: readViews
     * 自动识别可以使用的模板列表
     *
     *
     * @return \Illuminate\Http\Response
     */
    private function readViews()
    {
        $baseDir = dirname(__FILE__);
        $viewRoot = $baseDir.'/../../../../resources/views';
        if(!file_exists($viewRoot)) {

            return [];
        }
        $handle = opendir($viewRoot);
        $fileItem = [];
        if($handle) {
            while(($file = readdir($handle)) !== false) {
                $newPath = $viewRoot . DIRECTORY_SEPARATOR . $file;
                if(is_dir($newPath) && $file != '.' && $file != '..') {
                    $jsonFile = $newPath . '/.views.json';
                    if (file_exists($jsonFile))
                    {
                        $fileItem[] = $file;
                        $json = @file_get_contents($jsonFile);
                    }
                }
            }
        }
        @closedir($handle);

        return $fileItem;
    }

    /**
     * @name: updateTpl
     *   更新模板解释文件
     *
     * @param: String $code
     * @param: Json $jsonData
     *
     * @return: Boolen
     */

    private function updateTpl($code, $jsonData)
    {
        $baseDir = dirname(__FILE__);
        $jsonFile = $baseDir.'/../../../../resources/views/'.$code.'/.views.json';
        if(!file_exists($jsonFile)) {

            return false;
        } else {
            file_put_contents($jsonFile, json_encode($jsonData));
        }

        return true;
    }
}
