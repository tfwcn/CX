<?php namespace App\Extended\Model\Base;

use Illuminate\Database\Eloquent\Model;

class ModelBase extends Model
{
    public $timestamps = false;//��ʹ�� updated_at �� created_at �����ֶ�
    protected $primaryKey = 'f_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//	protected $fillable = ['f_id', 'f_create_time', 'f_version','f_update_time'];
}
