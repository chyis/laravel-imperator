<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends AdminController
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
        $query = Contacts::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::contact.index')
            ->with('lists', $list)
            ->with('pageName', '反馈管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chyis\Imperator\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chyis\Imperator\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts)
    {
        $contacts = Contacts::findOrfail();
        if ($contacts)
        {
            $contacts->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
