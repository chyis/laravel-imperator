<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Attributes;
use Chyis\Imperator\Models\Dictionary;
use Illuminate\Http\Request;

class AttributesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Attributes::orderBy('id', 'desc');
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::attributes.index')
            ->with('lists', $list)
            ->with('pageName', '内容属性管理');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Dictionary::ContentType()->get();

        return view('Imperator::attributes.create')
            ->with('pageName', '栏目添加')
            ->with('types', $types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = new Attributes();
        $attribute->cate_name = $request->input('cate_name');
        $attribute->parent_id = $request->input('parent_id');
        $attribute->type_id = $request->input('type_id');
        $attribute->sort = $request->input('sort');
        $attribute->image = $request->input('image') ?? '';
        $attribute->create_uid = 1;
        $res = $attribute->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        }

        return $this->error('失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function show(Attributes $attributes)
    {
        //
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function edit(Attributes $attributes)
    {
        $types = Dictionary::ContentType()->get();

//        $attributes = Category::findOrFail($attributes);
        if ($attributes)
        {
            return view('Imperator::attributes.edit')
                ->with('pageName', '栏目修改')
                ->with('types', $types)
                ->with('entity', $attributes);
        } else {
            return $this->error('没找到');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chyis\Imperator\Models\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attributes $attributes)
    {
        $attributes = Attributes::findOrFail($attributes);

        $attributes->cate_name = $request->input('cate_name');
        $attributes->parent_id = $request->input('parent_id');
        $attributes->type_id = $request->input('type_id');
        $attributes->sort = $request->input('sort');
        $attributes->image = $request->input('image') ?? '';
        $res = $attributes->saveOrFail();
        if ($res)
        {
            return $this->success('修改成功');
        } else {
            return $this->error('修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $attributes
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $attributes)
    {
        $attributes = Attributes::findOrFail($attributes);
        if ($attributes->id >0 )
        {
            $attributes->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
