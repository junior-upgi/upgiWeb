<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use App\Models\Staff;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract
{   
    // 使用驗證元件
    use Authenticatable;
    
    // 設定參數
    protected $connection = 'upgiSystem';
    protected $table = "user";
    protected $primaryKey = 'ID';
    public $keyType = 'string';
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * 回傳使用者對應之員工資料
     *
     * @return Model
     */
    public function staff()
    {
        return $this->hasOne(Staff::class, 'ID', 'erpID');
    }
}