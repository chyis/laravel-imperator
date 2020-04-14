<?php

namespace Chyis\Imperator\Controllers;

use App\Http\Controllers\Controller;
use Chyis\Imperator\Models\Menu;

class AdminController extends Controller
{
    protected $_privilegeAction = '';
    protected $_autoCheckPrivilege = true;

    /**
     * @name: __construct
     *  初始化controller层，引入权限策略，赋值菜单数据和配置数据
    */
    public function __construct()
    {

    }

    /**
     * @name: pageRequest
     *  初始化controller层，引入权限策略，赋值菜单数据和配置数据
     *
     *
     * @return bool
     */
    private function pageRequest()
    {
        if (! Request()->ajax() && Request()->isMethod('get'))
        {
            return true;
        }

        return false;
    }

    /**
     *  输出错误内容和提示
     *
     * @param: string $message
     * @param: int $errorNo
     * @param: array $data
     * @param: string $redirectURL
     *
     * @return: \Illuminate\Http\Response
     *
     * @example:
    */
    public function error($message, $errorNo = 1, $data = [],  $redirectURL= '')
    {
        return $this->messge($message, $errorNo, $data, $redirectURL);
    }

    /**
     *  输出成功内容和提示
     *
     * @param: string $message
     * @param: int $errorNo
     * @param: array $data
     * @param: string $redirectURL
     *
     * @return: \Illuminate\Http\Response
     *
     * @example:
    */
    public function success($message, $errorNo = 0, $data= [], $redirectURL= '')
    {
        return $this->messge($message, $errorNo, $data, $redirectURL);
    }

    /**
     * @name: messge
     *  输出内容和提示
     *
     * @param: string $message
     * @param: int $errorNo
     * @param: array $data
     * @param: string $redirectURL
     *
     * @return: \Illuminate\Http\Response
     *
     * @example:
    */
    public function messge($message, $errorNo = 0, $data= [], $redirectURL= '')
    {
        return ['msg'=>$message, 'code'=>$errorNo, 'data'=>$data, 'url'=>$redirectURL];
    }
}
