<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
 
    protected $fillable = ['user_id',  'description'];
 
    protected $guarded = ['id'];

    public static function getJoinUser()
	{
	    return Activity::join('users', 'users.id', '=', 'activities.user_id')->select('description', 'users.email as email', 'activities.id as id', 'activities.user_id', 'activities.created_at', 'activities.updated_at')->get();
	}
}
