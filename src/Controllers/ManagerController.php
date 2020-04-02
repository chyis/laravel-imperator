<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Requests\UserRequest;
use Chyis\Imperator\Models\Role;
use Illuminate\Http\Request;
use Chyis\Imperator\Models\Users;

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
        $query = Users::orderBy('id', 'desc')
            ->with('role');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        $roles = Role::getNames();

        return view('Imperator::user.index')
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

        return view('Imperator::user.create')
            ->with('roles', $roles)
            ->with('pageName', '用户添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\UserRequest  $request
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
     * @param  \Chyis\Imperator\Models\Users  $manager
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $manager)
    {
        $roles = Role::getNames();

        return view('Imperator::user.edit')
            ->with('entity', $manager)
            ->with('roles', $roles)
            ->with('pageName', '用户修改');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\UserRequest  $request
     * @param  \Chyis\Imperator\Models\Users  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, Users $manager)
    {
        $data['user_name'] = $request->input('username');
        $data['nick_name'] = $request->input('nickname');
        $data['role_id'] = intval($request->input('role_id'));
        if ($request->input('pwd') != '') {
            $data['password'] = bcrypt($request->input('pwd'));
        }
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['description'] = '';
        if ($res = $manager->where('id', $manager->id)->update($data)) {
            return $this->success('修改成功');
        } else {
            return $this->error('修改失败', 100, $manager);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chyis\Imperator\Models\Users  $manager
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $manager)
    {
        $manager = $manager->find();
        if ($manager)
        {
            $manager->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
