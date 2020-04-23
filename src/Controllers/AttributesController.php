<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Attributes;
use Chyis\Imperator\Models\Dictionary;
use Chyis\Imperator\Requests\AttributesRequest;
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
        $inputTypes = Attributes::getInputTypes();

        return view('Imperator::attributes.create')
            ->with('pageName', '属性添加')
            ->with('inputTypes', $inputTypes)
            ->with('types', $types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Chyis\Imperator\Requests\AttributesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AttributesRequest $request)
    {
        $attribute = new Attributes();
        $attribute->attr_name = $request->input('attr_name');
        $attribute->attr_code = $request->input('attr_code');
        $attribute->type_id = $request->input('type_id');
        $attribute->input_type = $request->input('input_type');
        $attribute->data_source = $request->input('data_source') ?? '';
        $attribute->validate = $request->input('validate') ?? '';
        $attribute->place_holder = $request->input('place_holder') ?? '';
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
        $inputTypes = Attributes::getInputTypes();

//        $attributes = Category::findOrFail($attributes);
        if ($attributes)
        {
            return view('Imperator::attributes.edit')
                ->with('pageName', '属性修改')
                ->with('inputTypes', $inputTypes)
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

        $attributes->attr_name = $request->input('attr_name');
        $attributes->attr_code = $request->input('attr_code');
        $attributes->type_id = $request->input('type_id');
        $attributes->input_type = $request->input('input_type');
        $attributes->data_source = $request->input('data_source') ?? '';
        $attributes->validate = $request->input('validate') ?? '';
        $attributes->place_holder = $request->input('place_holder') ?? '';
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
