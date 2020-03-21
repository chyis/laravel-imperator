<?php

namespace App\Http\Controllers;


use App\Models\Menu;

class AdminController extends Controller
{
    protected $_privilegeAction = '';
    protected $_autoCheckPrivilege = true;

    /*
     * @name: __construct
     *  初始化controller层，引入权限策略，赋值菜单数据和配置数据
     *
     * @param:
     * @return:
     *
     * @example:
    */
    public function __construct()
    {

    }

    private function pageRequest()
    {
        if (! Request()->ajax() && Request()->isMethod('get'))
        {
            return true;
        }

        return false;
    }

    /*
     * @name:error
     * @param:
     * @return:
     *
     * @example:
    */
    public function error($message, $errorNo = 1, $data = [], $redirectURL= '')
    {
        return $this->messge($message, $errorNo, [], $redirectURL);
    }

    /*
     * @name:success
     * @param:
     * @return:
     *
     * @example:
    */
    public function success($message, $errorNo = 0, $data= [], $redirectURL= '')
    {
        return $this->messge($message, $errorNo, $data, $redirectURL);
    }

    /*
     * @name:messge
     * @param:
     * @return:
     *
     * @example:
    */
    public function messge($message, $errorNo = 0, $data= [], $redirectURL= '')
    {
        return ['msg'=>$message, 'code'=>$errorNo, 'data'=>$data, 'url'=>$redirectURL];
    }
}
