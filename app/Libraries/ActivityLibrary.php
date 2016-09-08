<?php 
namespace App\Libraries 
{
	use App\Activity;

    class ActivityLibrary {

        public static function getActivities() {
        	$data = array();
        	$activities = Activity::getJoinUser();
	        if($activities){

	            foreach ($activities as $key => $value) {
	                $data[] = array(
	                    'id'          => $value->id,
	                    'user'        => array('id' => $value->user_id, 'email' => $value->email),
	                    'description' => $value->description,
	                    'created_at'  => $value->created_at,
	                    'updated_at'  => $value->updated_at
	                    );
	            }
	        }

            return $data;
        }

        public  function get()
		{
	    return  "ok";
		}

    }
}
?>
