<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'group_id', 'type', 'code', 'default_value', 'value_text', 'order'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'菜单名称',
        'group_id'=>'分组',
        'type'=>'类型代码',
        'code'=>'配置代码',
        'default_value'=>'权限ID',
        'value_text'=>'权限名称',
        'order'=>'排序',
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

    public static function getByCode($code)
    {
        $data = [];
        $tmp = Setting::all();
        foreach ($tmp as $key=>$value)
        {
            if ($code == $value['code']) return $value;
        }

        return $data;
    }

    public static function getValueByCode($code)
    {
        $data = '';
        $tmp = Setting::all();
        foreach ($tmp as $key=>$value)
        {
            if ($code == $value['code']) return $value['value_text'];
        }

        return $data;
    }

    public static function getCode($group_id = 0)
    {
        $data = [];
        if ($group_id == 0)
        {
            $tmp = Setting::all();
        } else {
            $tmp = Setting::where('group_id', $group_id)->all();
        }
        foreach ($tmp as $key=>$value)
        {
            $data[$value['code']] = $value['value_text'];
        }

        return $data;
    }

    public static function saveAll($setting, $group_id)
    {
        foreach ($setting as $key=>$val)
        {
            if ($val == '')
            {
                $val = '';
//                continue;
            }
            $exist = self::where('code', $key)->first();
            if (!isset($exist->id))
            {
                self::create(['code'=>$key, 'group_id'=>$group_id, 'title'=>'', 'type'=>'text', 'value_text'=>$val, 'order'=>'0']);
            } else {
                self::where('code', '=', $key) ->update(array('value_text' => $val, 'group_id'=>$group_id));
            }
            //self::where('code', '=', $key) ->update(array('artist' => 'Dayle Rees'));
        }
    }

    public static function addAll($setting, $group_id)
    {
        foreach ($setting as $key=>$val)
        {
//            self::create(['code'=>$key, 'group_id'=>$group_id, 'title'=>'', 'type'=>'text', 'value_text'=>$val, 'order'=>'0']);
            self::where('code', '=', $key) ->update(array('value_text' => $val, 'group_id'=>$group_id));
        }
    }
}