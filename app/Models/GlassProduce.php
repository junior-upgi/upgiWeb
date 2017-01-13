<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlassProduce extends Model
{
    //
    protected $connection = 'productDatabase';
    protected $table = "glassProduce";
    protected $dateFormat = 'Y-m-d H:i:s';
    public $keyType = 'string';
}
