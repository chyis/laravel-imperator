<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {

        return view('admin.role.index')
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
        //
        return view('admin.role.create')
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

        return view('admin.role.edit')
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
