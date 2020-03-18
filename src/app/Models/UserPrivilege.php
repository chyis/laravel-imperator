<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_privilege';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'pri_id'];
    public $attributeNames = [
        'id'=>'编号',
        'user_id'=>'用户id',
        'pri_id'=>'权限ID',
        'privilege_name'=>'权限名称'
    ] ;
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

    public static function getByUserID($userID)
    {
        $priv = [];
        $tmp = self::select('pri_id')
            ->where('user_id', $userID)
            ->get()
            ->toarray();
        if (!empty($tmp))
        {
            foreach ($tmp as $k=>$val)
            {
                $priv[] = $val['pri_id'];
            }
        }

        return $priv;
    }

    public static function hasPriID($userID, $privID)
    {
        if ($userID == 1) return true;
        $privileges = self::getByUserID($userID);
        if (in_array($privID, $privileges))
        {
            return true;
        }

        return false;
    }

    public function hasPriCode($userID, $code)
    {
        return self::where('code', $code)
            ->findOrFail();
    }
}
