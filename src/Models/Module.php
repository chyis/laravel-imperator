<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'page_id', 'page_code', 'content', 'length'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'名称',
        'type'=>'类型',
        'page_id'=>'页面ID',
        'page_code'=>'页面代码',
        'content'=>'内容',
        'length'=>'尺寸',
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
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    //protected $connection = 'connection-name';

    public function page()
    {
        $pageID = $this->getAttribute('page_id');

        return Dictionary::find($pageID);
//        return $this->belongsTo('\Models\Dictionary', 'page_id', 'id');
    }

    public function getSourceTypeAttribute()
    {
        $type = $this->getAttribute('type');

        return in_array($type, ['hot-news', 'top-news', 'fast-news', 'select-news']);
    }

    public function getManualTypeAttribute()
    {
        $type = $this->getAttribute('type');

        return !in_array($type, ['select-news', 'select-adv', 'select-goods', 'select-service']);
    }

    public function getContentList()
    {
        $type = $this->getAttribute('type');
        $content = $this->getAttribute('content');

        switch ($type)
        {
            case 'select-adv':
                $dataList = Advertise::whereIn('id', explode(',', $content))->get();
                return $dataList;
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

    public function getPageModules($pageCode)
    {
        $modules = $this->where('page_code', $pageCode)->get();
        $res = [];
        foreach ($modules as $module) {
            $res[$module->code] = $module;
        }

        return $res;
    }

    public static function getModuleByCode($moduleCode)
    {

    }
}
