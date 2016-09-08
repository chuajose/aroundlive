<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Activity;

use App\Http\Requests\ActivityForm;

use Validator;

use Illuminate\Support\Facades\Cache;

use \App\Libraries\ActivityLibrary;

class ActivityController extends Controller
{
    public function __construct()
    {
    

        $this->middleware('jwt.auth', ['except' => ['index']]); //afecta a todo la class para requerir token
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['activities'] = ActivityLibrary::getActivities();

        $classObj = new ActivityLibrary();
        $data['ok2'] = $classObj->get();

        /*$classObj = new ActivityLibrary();
        $data['ok'] = $classObj->is_ok();*/

        return response()->json( $data );
    }
 
    /**
     * @param ActivityForm $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ActivityForm $request)
    {
       /*$validator = Validator::make($request->all(), [
            'description' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['message' => 'error saved']);

        }*/

        $activity = new Activity();
        $activity->user_id = $request->input('user_id');
        $activity->description = $request->input('description');
        $activity->save();
        return response()->json(['message' => 'Activity saved']);
        
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        return response()->json(['activity' => $activity]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityForm $request, $id)
    {
        if($request->ajax())
        {
            $activity = Activity::find($id);
            $activity->user_id = $request->input('user_id');
            $activity->description = $request->input('description');
            $activity->save();
            return response()->json(['message' => 'Activity updated']);
        }
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        return response()->json(['message' => 'Activity removed']);
    }
}
