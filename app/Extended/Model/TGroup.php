<?php namespace App\Extended\Model;

use App\Extended\Model\Base\ModelBase;

class TGroup extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 't_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//	protected $fillable = ['f_id', 'f_create_time', 'f_update_time', 'f_version'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
    /**
     * 不赋值字段
     * @var array
     */
    //protected $guarded = [];

}