<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Models\Category;
use Chyis\Imperator\Models\Dictionary;
use Illuminate\Http\Request;
use Chyis\Imperator\Requests\CategoryRequest;

class CategoryController extends AdminController
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
        $query = Category::orderBy('id', 'desc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('admin.tools.perPage'));

        return view('Imperator::category.index')
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
        $parents = Category::root()->get();
        $types = Dictionary::ContentType()->get();

        return view('Imperator::category.create')
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
    public function store(CategoryRequest $request)
    {
        $cate = new Category();
        $cate->cate_name = $request->input('cateName');
        $cate->parent_id = $request->input('parentID');
        $cate->type_id = $request->input('typeID');
        $cate->sort = $request->input('sort');
        $cate->image = '';
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
        $cate = Category::findOrFail($id);

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
        $parents = Category::root()->get();
        $types = Dictionary::ContentType()->get();

        $cate = Category::findOrFail($id);
        if ($cate)
        {
            return view('Imperator::category.edit')
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
    public function update(CategoryRequest $request, int $category)
    {
        $category = Category::findOrFail($category);

        $category->cate_name = $request->input('cate_name');
        $category->parent_id = $request->input('parent_id');
        $category->type_id = $request->input('type_id');
        $category->sort = $request->input('sort');
        $category->image = '';
        $res = $category->saveOrFail();
        if ($res)
        {
            return $this->success('修改成功');
        } else {
            return $this->error('修改失败');
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \Chyis\Imperator\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $category)
    {
        $category = Category::findOrfail($category);
        if ($category)
        {
            $category->delete();

            $this->success('删除成功');
        } else {
            $this->error('该内容不存在');
        }
    }
}
