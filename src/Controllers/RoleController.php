<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Privilege;
use Chyis\Imperator\Models\Role;
use Chyis\Imperator\Models\RolePrivilege;
use Chyis\Imperator\Requests\RoleRequest;

class RoleController extends AdminController
{

    public function index()
    {
        $keyWord = Request()->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['title', $keyWord];
        }
        $query = Role::orderBy('id', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));
        return view('Imperator::role.index')
            ->with('lists', $list)
            ->with('pageName', '角色管理');
    }

    /**
     * Show the form for creating a new resource.
     * GET /news/create
     *
     * @return Response
     */

    public function create()
    {
        $privileges = Privilege::getTree();

        return view('Imperator::role.create')
            ->with('privTree', $privileges)
            ->with('pageName', '角色添加');
    }


    /**
     * Store a newly created resource in storage.
     * POST /news
     *
     * @param  \Chyis\Imperator\Requests\RoleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store(RoleRequest $request)
    {
        $data = [];
        $data['name'] = $request->input('role_name');
        $data['code'] = $request->input('role_code') ?? '';
        $data['icon'] = $request->input('role_icon') ?? '';
        $data['min_s'] = $request->input('min_s') ?? 0;
        $data['max_s'] = $request->input('max_s') ?? 0;
        $data['department_id'] = $request->input('department_id') ?? 0;

        $roleID = Role::insertGetId($data);
        if ($roleID) {
            $privileges = $request->input('privileges');
            $rolePrivilege = [];
            foreach ($privileges as $k =>$priv_id) {
                $rolePrivilege[] = ['role_id'=>$roleID, 'pri_id'=>$priv_id];
            }
            RolePrivilege::insertAll($rolePrivilege);
            return $this->success('添加成功');
        } else {
            return $this->error('添加失败');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /role/{id}/edit
     *
     *@param  \Chyis\Imperator\Models\Role $role
     *
     * @return Response
     */

    public function edit(Role $role)
    {
        $privileges = Privilege::getTree();
        $rolePrivileges = RolePrivilege::getByRoleID($role->id);

        return view('Imperator::role.edit')
            ->with('entity', $role)
            ->with('privTree', $privileges)
            ->with('rolePrivileges', $rolePrivileges)
            ->with('pageName', '角色修改');
    }

    /**
     * Update the specified resource in storage.
     * PUT /role/{role}
     *
     * @param  \Chyis\Imperator\Requests\RoleRequest  $request
     * @param  \Chyis\Imperator\Models\Role $role
     *
     * @return Response
    */
    public function update(RoleRequest $request, Role $role)
    {
        $data = [];
        $data['name'] = $request->input('role_name');
        $data['code'] = $request->input('role_code') ?? '';
        $data['icon'] = $request->input('role_icon') ?? '';
        $data['min_s'] = $request->input('min_s') ?? 0;
        $data['max_s'] = $request->input('max_s') ?? 0;
        $data['department_id'] = $request->input('department_id') ?? 0;

        $role->saveOrFail($data);
        $privileges = $request->input('privileges');
        $userPrivilege = [];
        foreach ($privileges as $k =>$priv_id) {
            $userPrivilege[] = ['role_id'=>$role->id, 'pri_id'=>$priv_id];
        }
        RolePrivilege::where('role_id', $role->id)->delete();
        RolePrivilege::insertAll($userPrivilege);

        return $this->success('保存成功');
    }


    /**
     * Remove the specified resource from storage.
     * DELETE /news/{id}
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
