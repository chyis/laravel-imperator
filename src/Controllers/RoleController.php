<?php

namespace Chyis\Imperator\Controllers;

use App\Http\Controllers\Controller;
use Chyis\Imperator\Models\Privilege;
use Chyis\Imperator\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $keyWord = Request()->input('keyword');
        $condition = [];

        if ($keyWord != '')
        {
            $condition[] = ['title', $keyWord];
        }
        $query = Role::orderBy('sort', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));
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
     * @return Response
     */

    public function store(Request $request)
    {
        $request = $request->toArray();
        $title = $request['title'];
        echo $title;

        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     * GET /role/{id}/edit
     *
     * @param int $id
     * @return Response
     */

    public function edit($id)
    {

        return view('Imperator::role.edit')
            ->with('pageName', '角色修改');
    }

    /**
     * Update the specified resource in storage.
     * PUT /role/{id}
     *
     * @param int $id
     * @return Response
    */
    public function update($id)
    {
        $this->validate([]);

        return;
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
