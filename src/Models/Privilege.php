<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'privilege';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'group_id', 'http_method', 'http_path'];
    public $attributeNames = [
        'id'=>'编号',
        'name'=>'权限名',
        'code'=>'开发者标识',
        'group_id'=>'权限分组',
        'group_name'=>'权限分组名',
        'http_method'=>'请求类型',
        'http_path'=>'请求地址',
        'create_uid'=>'创建人ID',
        'create_username'=>'创建人',
        'last_uid'=>'修改人人ID',
        'last_username'=>'修改人',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];
    protected $needPri = [];
    /*
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    //public $timestamps = false;
    /*
     * 模型日期列的存储格式
     *
     * @var string
     */
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    /*
     * The connection name for the models.
     *
     * @var string
     */
    //protected $connection = 'connection-name';
    public static $http_method = ['get', 'put', 'post', 'delete', 'options', 'connect', 'head', 'trace'];
    public static $sourceMethod = ['index', 'create', 'edit', 'delete', 'show'];


    public static function getTree()
    {
        $privGroup = Dictionary::where('var_code', 'prigroup')
            ->where('parent_id', '>' , 0)
            ->get();
        $roots = [];
        foreach ($privGroup as $k=>$value)
        {
            if ($value->type == 1) {
                $roots[$value->id] = $value->toarray();
            } else {
                $roots[$value->parent_id]['child'][$value->id] = $value->toarray();
                $branches[$value->id] = $value;
            }
        }

        $privileges = self::all();

        foreach ($privileges as $key=>$value) {
            $branch = $branches[$value->group_id];
            $roots[$branch->parent_id]['child'][$branch->id]['child'][$value->id] = $value->toArray();
        }

        return $roots;
    }


    public function getByCode($code = '')
    {
        if ($code != '')
        {
            return self::where('code', $code)->first();
        }

        return null;
    }

    public function getGroupNameAttribute()
    {
        if ($this->getAttribute('group_id') > 0)
        {
            $type = Dictionary::find($this->getAttribute('group_id'));
            if ($type)
            {
                return $type->var_name;
            }
        }
        return '无';
    }


    public static function splitUrl($url)
    {
        $uri = explode('/', $url);

        return last($uri);
    }

    public static function makeSourceData($name, $httpPath, $code, $action)
    {
        $data = [];
        $lastChar = substr($httpPath, -1);
        if ($lastChar == '/')
        {
            $httpPath .= substr($httpPath, 0, -1);
        }

        $lastChar = substr($code, -1);
        if ($lastChar == '.')
        {
            $code .= substr($code, 0, -1);
        }

        switch ($action)
        {
            case 'index':
                $data['http_path'] = $httpPath;
                $data['http_method'] = 'get';
                $data['code'] = $code . '.index';
                $data['name'] = $name . ' 列表管理';
                break;
            case 'show':
                $data['http_path'] = $httpPath.'/{id}';
                $data['http_method'] = 'get';
                $data['code'] = $code . '.show';
                $data['name'] = $name . ' 详情浏览';
                break;
            case 'create':
                $data['http_path'] = $httpPath . '/create';
                $data['http_method'] = 'get';
                $data['code'] = $code . '.create';
                $data['name'] = $name . ' 信息添加';
                break;
            case 'edit':
                $data['http_path'] = $httpPath.'/{id}/edit';
                $data['http_method'] = 'get';
                $data['code'] = $code . '.edit';
                $data['name'] = $name . ' 信息修改';
                break;
            case 'delete':
                $data['http_path'] = $httpPath.'/{id}';
                $data['http_method'] = 'delete';
                $data['code'] = $code . '.destroy';
                $data['name'] = $name . ' 信息删除';
                break;

        }

        return $data;
    }

}
