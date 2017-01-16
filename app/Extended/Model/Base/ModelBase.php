<?php namespace App\Extended\Model\Base;

use Illuminate\Database\Eloquent\Model;

class ModelBase extends Model
{
    public $timestamps = false;//不使用 updated_at 和 created_at 两个字段
    protected $primaryKey = 'f_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//	protected $fillable = ['f_id', 'f_create_time', 'f_version','f_update_time'];
}
