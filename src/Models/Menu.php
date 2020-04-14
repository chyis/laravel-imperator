<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Chyis\Imperator\Models\UserPrivilege;

class Menu extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'parent_id', 'type_id', 'url', 'sort', 'privelege_id'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'菜单名称',
        'url'=>'菜单地址',
        'parent_id'=>'菜单父类',
        'parent_name'=>'父类名',
        'type_id'=>'类型字典ID',
        'type'=>'类型代码',
        'type_name'=>'类型名称',
        'privilege_id'=>'权限ID',
        'privelege_name'=>'权限名称',
        'position'=>'位置代码',
        'icon'=>'图标',
        'order'=>'排序',
//        'create_uid'=>'创建人ID',
//        'create_username'=>'创建人',
        'is_delete'=>'删除与否',
        'status_name'=>'状态',
        'deleted_at'=>'删除时间',
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

    function scopeRoot($query)
    {
        return $query->where('parent_id', '0');
    }

    public static function getTypeTree($type, $position = '', $userID = 0)
    {
        $tree = [];
        $query = self::where('type', $type);
        if ($position != '')
        {
            $query->where('position', $position);
        }
        $tmp = $query
            ->orderby('parent_id', 'asc')
            ->orderby('order', 'asc')
            ->get()
            ->toarray();
        foreach ($tmp as $val)
        {
            if ($val['parent_id'] == 0)
            {
                $tree[$val['id']] = $val;
            } else {
                if ($userID > 0 && UserPrivilege::hasPriID($userID, $val['privilege_id']))
                {
                    $tree[$val['parent_id']]['child'][$val['order']] = $val;
                } else if ($userID == 0) {
                    $tree[$val['parent_id']]['child'][$val['order']] = $val;
                }
            }
        }

        return $tree;
    }

    public function getDirsAttribute()
    {
        if ($this->getAttribute('parent_id') > 0)
        {
            $id = $this->getAttribute('parent_id');
            $parent = menu::find($id);

            return '| —— '. $parent->title .' —— ';
        }
        return '| ——';
    }

    public function getStatusNameAttribute()
    {
        if ($this->getAttribute('deleted_at') != '') return '已删除';
        return '可用';
    }

    public function parent()
    {
        $id = $this->getAttribute('parent_id');
        $parentDict = menu::find($id);
        if ($parentDict)
        {
            return $parentDict;
        }

        return null;
    }

    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('type_id') > 0)
        {
            $type = Dictionary::find($this->getAttribute('type_id'));
            if ($type) {
                return $type->var_name;
            }
        }

        return '未知';
    }

    public function getDirNameAttribute()
    {
        if ($this->getAttribute('parent_id') == 0) return '初代目';
        if ($this->getAttribute('parent_id') > 0) return '二代目';
        return '三代目';
    }

    public function getCreateUserAttribute()
    {
        $create_uid = $this->getAttribute('create_uid');
        $creatUser = App/Models/Users::find($create_uid);
        if ($creatUser)
        {
            return $creatUser;
        }

        return null;
    }

}
