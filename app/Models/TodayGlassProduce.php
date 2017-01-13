<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodayGlassProduce extends Model
{
    //
    protected $connection = 'productDatabase';
    protected $table = "todayGlassProduce";
    protected $dateFormat = 'Y-m-d H:i:s';
    public $keyType = 'string';
}
