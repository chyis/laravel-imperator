<?php

namespace Chyis\Imperator\Controllers;

use Chyis\Imperator\Models\Classification;
use Chyis\Imperator\Models\Product;
use Chyis\Imperator\Models\ProductContent;
use Illuminate\Http\Request;
use Chyis\Imperator\Requests\ProductRequest;

class ProductsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyWord = $request->input('keyword');
        $searchField = $request->input('search_field');
        $condition = [];

        if ($keyWord != '' && $searchField == 'name')
        {
            $condition[] = ['title', $keyWord];
        } else if ($keyWord != '' && $searchField == 'group') {
            $condition[] = ['id', $keyWord];
        }
        $query = Product::orderBy('created_at', 'asc')
            ->orderBy('id', 'asc');
        if (!empty($query))
        {
            $query->where($condition);
        }
        $list = $query
            ->paginate(config('imperator.tools.perPage'));

        return view('Imperator::products.index')
            ->with('lists', $list)
            ->with('pageName', '产品管理')
            ->with('request', $request->toArray());
    }

    /**
     * Show the form for creating a new resource.
     * GET /news/create
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Classification::dirRoot();

        return view('Imperator::products.create')
            ->with('pageName', '产品添加')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     * POST /news
     * @param \Chyis\Imperator\Requests\ProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store(ProductRequest $request)
    {
        $article = new Product();
        $article->title = $request->input('title');
        $article->cate_id = $request->input('cate_id');
        $article->price = $request->input('price');
        $article->org_price = $request->input('org_price');
        $article->image = $request->input('image') ?? '';
        $article->description = $request->input('description') ?? '';
        $article->on_sale = intval($request->input('on_sale'));

        if ($res = $article->save())
        {
            $id = $article->id;
            if ($id>0)
            {
                $content = new ProductContent();
                $content->product_id = $id;
                $content->content = $request->input('content');;
                $content->create_user = 1;
                $content->extends  = '';
//                $content->last_modify_user = $id;
                $content->save();
            }
            return $this->success('成功');
        } else {
            return $this->errot('新增失败');
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /news/create
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function edit(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('未找到');
        }

        $category = Classification::dirRoot();

        return view('Imperator::products.edit')
            ->with('entity', $product)
            ->with('category', $category)
            ->with('pageName', '产品修改');
    }

    /**
     * Store a newly created resource in storage.
     * POST /news
     *
     * @param int $id
     * @param \Chyis\Imperator\Requests\ProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Product $products, ProductRequest $request)
    {
        $products->title = $request->input('title');
        $products->cate_id = $request->input('cate_id');
        $products->price = $request->input('price');
        $products->org_price = $request->input('org_price');
        $products->image = $request->input('image') ?? '';
        $products->description = $request->input('description') ?? '';
        $products->on_sale = intval($request->input('on_sale'));

        if ($res = $products->save())
        {
            $content = ProductContent::where("product_id", $products->id)->first();
            $content->content = $request->input('content');;
            $content->create_user = 1;
            $content->extends  = '';
            $content->save();
            return $this->success('成功');
        } else {
            return $this->errot('新增失败');
        }
    }

    /**
     * Make a grid builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Product);

        $table->title('产品列表管理');
        $table->addCollum('id')->sortable();
        $table->addCollum('title');
        $table->addCollum('cate_name')->sortable('cate_id');
        $table->extralCollum(['view_count', '']);
        $table->actions(['remove', 'edit', 'delete']);
        $table->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $table;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
        $form->text('title', '服务名称')->rules('required');

        // 创建一个选择图片的框
        $form->image('image', '封面图片')->rules('required|image');

        // 创建一个富文本编辑器
        $form->editor('description', '服务描述')->rules('required')->fill(['config.filebrowserImageUploadUrl'=>'/admin/upload']);

        // 创建一组单选框
        $form->radio('on_sale', '上架')->options(['1' => '是', '0'=> '否'])->default('0');

        // 直接添加一对多的关联模型
        $form->hasMany('skus', '服务项列表', function (Form\NestedForm $form) {
            $form->text('title', '服务项 名称')->rules('required');
            $form->text('description', '服务项 描述')->rules('required');
            $form->text('price', '单价')->rules('required|numeric|min:0.01');
        });

        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });

        return $form;
    }


}
