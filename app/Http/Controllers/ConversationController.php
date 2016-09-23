<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//use App\Http\Requests;

use App\Conversation;

use App\Http\Requests\ActivityForm;

use Validator;

use Illuminate\Support\Facades\Cache;

use \App\Libraries\ConversationLibrary;

//use \App\Http\Controllers\Input;

use Illuminate\Support\Facades\Request;



class ConversationController extends Controller
{
    public function __construct()
    {
    

        //$this->middleware('jwt.auth', ['except' => ['index']]); //afecta a todo la class para requerir token
        $this->middleware('jwt.auth'); //afecta a todo la class para requerir token
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['activities'] = ConversationLibrary::getActivities();

        $classObj = new ConversationLibrary();
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

        $activity = new Conversation();
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
        //$activity = Conversation::with(['user'])->find($id); //get by id conversation
        $activity = Conversation::where('user_id_fk', $id)->with(['user'])->get();//get by id user

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
            $activity = Conversation::find($id);
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
        $activity = Conversation::find($id);
        $activity->delete();
        return response()->json(['message' => 'Activity removed']);
    }

    /**
     * Upload the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        $imageName = "prueba";
        $file = Request::file('file');
        $ext = $file->getClientOriginalExtension();
        $file->move(
            base_path() . '/public/images/catalog/', $imageName
        );


        return response()->json(['message' => $ext]);
    }
}
