<?php namespace App\Extended\Model;

use App\Extended\Model\Base\ModelBase;

class TUser extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 't_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//	protected $fillable = ['f_id', 'f_create_time', 'f_version','f_login_name','f_login_password','f_password_key','f_email'];

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

//	public function TUserInfo()
//	{
//		return $this->hasOne('App\Extended\Model\TUserInfo','f_user_id','f_id');
//	}
}