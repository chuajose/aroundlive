<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'conversations';
 
    protected $fillable = ['user_id',  'description'];
 
    protected $guarded = ['id'];

    public static function getJoinUser()
	{
	    return Activity::join('users', 'users.id', '=', 'conversations.user_id_fk')->select('description', 'users.email as email', 'conversations.id as id', 'conversations.user_id_fk', 'conversations.created_at', 'conversations.updated_at')->get();
	}
}
