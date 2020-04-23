<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'attributes';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['cate_name', 'parent_id', 'sort'];
    public $attributeNames = [
        'id'=>'编号',
        'attr_name'=>'属性名',
        'type_id'=>'类型ID',
        'type_name'=>'类型名称',
        'attr_code'=>'属性标识',
        'input_type'=>'输入类型',
        'data_source'=>'备选数据来源',
        'validate'=>'验证方法',
        'place_holder'=>'占位内容',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];

    protected $inputTypes = [
        'text'=>'输入框',
        'select'=>'下拉列表',
        'radio'=>'单选框',
        'file'=>'文件上传',
        'image'=>'图片上传',
        'checkbox'=>'多选框',
        'textarea'=>'文本框',
        'date'=>'日期控件',
        'time'=>'时刻控件',
        'datetime'=>'时间控件',
        'hidden'=>'隐藏域',
        'color'=>'选色卡',
        'captcha'=>'验证码',
        'map'=>'地图',
        'area'=>'省市区',
        'password'=>'密码',
        'switch'=>'开关',
        'html'=>'html'
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



    public static function getInputTypes() {
        return (new static)->inputTypes;
    }

    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('type_id') > 0)
        {
            $type = Dictionary::find($this->getAttribute('type_id'));
            if ($type)
            {
                return $type->var_name;
            }
        }
        return '未知';
    }

    public function getHtmlAttribute($defaultVal = '')
    {
        $type = $this->getAttribute('input_type');
        $dataSource = $this->getAttribute('data_source');
        $placeHolder = $this->getAttribute('place_holder');
        $validate = $this->getAttribute('validate');
        switch ($type)
        {
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            case '':

                break;
            default:

                break;

        }

    }

    public function getInputNameAttribute()
    {
        if ($this->getAttribute('input_type') == 'text') return '输入框';
        if ($this->getAttribute('input_type') == 'select') return '下拉列表';
        if ($this->getAttribute('input_type') == 'radio') return '单选框';
        if ($this->getAttribute('input_type') == 'file') return '文件上传';
        if ($this->getAttribute('input_type') == 'image') return '图片上传';
        if ($this->getAttribute('input_type') == 'checkbox') return '多选框';
        if ($this->getAttribute('input_type') == 'textarea') return '文本框';
        if ($this->getAttribute('input_type') == 'date') return '日期控件';
        if ($this->getAttribute('input_type') == 'time') return '时刻控件';
        if ($this->getAttribute('input_type') == 'datetime') return '时间控件';
        if ($this->getAttribute('input_type') == 'hidden') return '隐藏域';
        if ($this->getAttribute('input_type') == 'color') return '选色卡';
        if ($this->getAttribute('input_type') == 'captcha') return '验证码';
        if ($this->getAttribute('input_type') == 'map') return '地图';
        if ($this->getAttribute('input_type') == 'password') return '密码';
        if ($this->getAttribute('input_type') == 'switch') return '开关';
        if ($this->getAttribute('input_type') == 'html') return 'html';
        return '未定义';
    }


    function scopeArticle($query)
    {
        return $query->where('type_id', 'in', []);
    }

    function scopeProduct($query)
    {
        return $query->where('type_id', 'in', []);
    }

}
