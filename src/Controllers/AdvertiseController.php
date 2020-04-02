<?php

namespace Chyis\Imperator\Controllers;


use Illuminate\Http\Request;
use Chyis\Imperator\Models\Dictionary;
use Chyis\Imperator\Models\Advertise;
use Chyis\Imperator\Requests\AdvertiseRequest;


class AdvertiseController extends AdminController
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
            $condition[] = ['title', $keyWord];
        }
        $query = Advertise::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::advertise.index')
            ->with('pageName', '广告管理')
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
        $types = Dictionary::menuType()->get();

        return view('Imperator::advertise.create')
            ->with('types', $types)
            ->with('pageName', '菜单添加');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\AdvertiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertiseRequest $request)
    {
        $advertise = new Advertise();
        $data['title'] = $request->input('title');
        $data['url'] = $request->input('url') ?? '';
        $data['type'] = $request->input('type') ?? '';
        $data['src'] = $request->input('src') ?? '';
        $data['text'] = $request->input('text') ?? '';
        $data['size'] = $request->input('size') ?? '';
        $data['start_time'] = $request->input('start_time') ?? time();
        $data['end_time'] = $request->input('end_time') ?? 0;
        $res = $advertise->create($data);
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Advertise  $advertise
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Advertise $advertise)
    {

        return view('Imperator::advertise.show')
            ->with('advertise', $advertise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertise $advertise)
    {
        $types = Dictionary::menuType()->get();

        return view('Imperator::advertise.edit')
            ->with('types', $types)
            ->with('pageName', '广告修改')
            ->with('entity', $advertise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chyis\Imperator\Requests\AdvertiseRequest  $request
     * @param  \Chyis\Imperator\Models\Advertise  $advertise
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertiseRequest $request, Advertise $advertise)
    {
        $data['title'] = $request->input('title');
        $data['url'] = $request->input('url') ?? '';
        $data['type'] = $request->input('type') ?? '';
        $data['src'] = $request->input('src') ?? '';
        $data['text'] = $request->input('text') ?? '';
        $data['size'] = $request->input('size') ?? '';
        $data['start_time'] = $request->input('start_time') ?? time();
        $data['end_time'] = $request->input('end_time') ?? 0;
        $res = $advertise->update($data);
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chyis\Imperator\Models\Advertise  $advertise
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertise $advertise)
    {
        if ($advertise)
        {
            $advertise->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
