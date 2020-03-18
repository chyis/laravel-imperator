<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Users;

class ManagerController extends AdminController
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
            $condition[] = ['username', $keyWord];
        }
        $query = Users::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        $roles = Role::getNames();

        return view('admin.user.index')
            ->with('pageName', '用户管理')
            ->with('roles', $roles)
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
        $roles = Role::getNames();

        return view('admin.user.create')
            ->with('roles', $roles)
            ->with('pageName', '用户添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function store(UserRequest $request)
    {
        $data['user_name'] = $request->input('username');
        $data['nick_name'] = $request->input('nickname');
        $data['role_id'] = intval($request->input('role_id'));
        $data['password'] = bcrypt($request->input('pwd'));
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['description'] = '';

        if (Users::create($data))
        {
            return $this->success('添加成功');
        }

        return $this->error('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $roles = Role::getNames();
        $user = Users::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $user = Users::find($id);
        $roles = Role::getNames();

        return view('admin.user.edit')
            ->with('entity', $user)
            ->with('roles', $roles)
            ->with('pageName', '用户修改');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, Users $user)
    {
        $data['user_name'] = $request->input('username');
        $data['nick_name'] = $request->input('nickname');
        $data['role_id'] = intval($request->input('role_id'));
        $data['password'] = bcrypt($request->input('pwd'));
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['description'] = '';
        $user->update($data);

        return $this->success('修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = Users::findOrfail($id);
        if ($user)
        {
            $user->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
