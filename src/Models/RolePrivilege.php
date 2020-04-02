<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolePrivilege extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role_privilege';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'pri_id'];
    public $attributeNames = [
        'id'=>'编号',
        'role_id'=>'角色id',
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

    public static function getByRoleID($roleID)
    {
        $priv = [];
        $tmp = self::select('pri_id')
            ->where('role_id', $roleID)
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

    public static function hasPriID($roleID, $privID)
    {
        if ($roleID == 1) return true;
        $privileges = self::getByUserID($roleID);
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

    public static function insertAll($data) {
        return DB::table('role_privilege')->insert($data);
    }
}
