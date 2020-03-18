<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    use SoftDeletes;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'dictionary';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['var_name', 'var_code', 'parent_id', 'sort'];
    public $attributeNames = [
            'id'=>'编号',
            'var_name'=>'字典名称',
            'var_code'=>'字典标识',
            'parent_id'=>'字典父类',
            'parent_name'=>'父类名',
            'type'=>'级别',
            'type_name'=>'级别名称',
            'create_uid'=>'创建人ID',
            'create_username'=>'创建人',
            'last_uid'=>'修改人人ID',
            'last_username'=>'修改人',
            'var_value'=>'字典值',
            'sort'=>'排序',
            'is_delete'=>'删除与否',
            'status_name'=>'状态',
            'deleted_at'=>'删除时间',
            'created_at'=>'创建时间',
            'updated_at'=>'更新时间'
        ];
    protected $needPri = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    //public $timestamps = false;
    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    //protected $dateFormat = 'U';
    /**
     * The connection name for the models.
     *
     * @var string
     */
    //protected $connection = 'connection-name';

    public static function getNameByID($id)
    {
        $data = self::where('parent_id', '>', 0)
            ->orderby('parent_id', 'desc')
            ->all()
            ->keyBy('id')
            ->toArray();;

    }

    public function getStatusNameAttribute()
    {
        if ($this->getAttribute('isDelete') == 1) return '已删除';
        if ($this->getAttribute('isDelete') == 0) return '可用';
        return '未知';
    }

    public function parent()
    {
        $id = $this->getAttribute('parent_id');
        $parentDict = Dictionary::find($id);
        if ($parentDict)
        {
            return $parentDict;
        }

        return null;
    }

    public function getDirsAttribute()
    {
        if ($this->getAttribute('type') == 1) return '| —— ';
        if ($this->getAttribute('type') == 2) return '| ——| —— ';
        return '';
    }

    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('type') == 0) return '初代目';
        if ($this->getAttribute('type') == 1) return '二代目';
        if ($this->getAttribute('type') == 2) return '分支';
        return '未知';
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

    public function getLastUserAttribute()
    {
        $last_uid = $this->getAttribute('last_uid');
        $lastUser = App/Models/Users::find($last_uid);
        if ($lastUser)
        {
            return $lastUser;
        }

        return null;
    }

    public function scopeMenuType($query)
    {
        return $this->where('var_code', 'menutype')
            ->where('parent_id', '>', 0);
    }

    public function scopeContentType($query)
    {
        return $this->where('var_code', 'newstype')
            ->where('parent_id', '>', 0);
    }

    public function scopePosType($query)
    {
        return $this->where('var_code', 'pos')
            ->where('parent_id', '>', 0);
    }

    public function scopePrivType($query)
    {
        return $this->where('var_code', 'prigroup')
            ->where('parent_id', '>', 0);
    }

    public function scopePartnerType($query)
    {
        return $this->where('var_code', 'links')
            ->where('parent_id', '>', 0);
    }

    public function scopePageType($query)
    {
        return $this->where('var_code', 'pages')
            ->where('parent_id', '>', 0);
    }

}
