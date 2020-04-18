<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Classification;
use Chyis\Imperator\Models\Dictionary;
use Illuminate\Http\Request;
use Chyis\Imperator\Requests\classificationRequest;

class ClassificationController extends AdminController
{
    /*
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
            $condition[] = ['cate_name', $keyWord];
        }
        $query = Classification::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::classification.index')
            ->with('lists', $list)
            ->with('pageName', '栏目管理')
            ->with('request', $request->toArray());
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Classification::root()->get();
        $types = Dictionary::ProductType()->get();

        return view('Imperator::classification.create')
            ->with('pageName', '栏目添加')
            ->with('types', $types)
            ->with('parents', $parents);
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassificationRequest $request)
    {
        $cate = new Classification();
        $cate->cate_name = $request->input('cate_name');
        $cate->parent_id = $request->input('parent_id');
        $cate->type_id = $request->input('type_id');
        $cate->sort = $request->input('sort');
        $cate->image = $request->input('image') ?? '';
        $cate->create_uid = 1;
        $res = $cate->saveOrFail();
        if ($res)
        {
            return $this->success('成功');
        } else {
            return $this->error('失败');
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $cate = Classification::findOrFail($id);

        return $cate;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $parents = Classification::root()->get();
        $types = Dictionary::ProductType()->get();

        $cate = Classification::findOrFail($id);
        if ($cate)
        {
            return view('Imperator::classification.edit')
                ->with('pageName', '栏目修改')
                ->with('parents', $parents)
                ->with('types', $types)
                ->with('entity', $cate);
        } else {
            return $this->error('没找到');
        }
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(ClassificationRequest $request, int $category)
    {
        $category = Classification::findOrFail($category);

        $category->cate_name = $request->input('cate_name');
        $category->parent_id = $request->input('parent_id');
        $category->type_id = $request->input('type_id');
        $category->sort = $request->input('sort');
        $category->image = $request->input('image') ?? '';
        $res = $category->saveOrFail();
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
     * @param  int $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $category)
    {
        $category = Classification::findOrFail($category);
        if ($category->id >0 )
        {
            $category->delete();

            return $this->success('删除成功');
        } else {
            return $this->error('该内容不存在');
        }
    }
}
