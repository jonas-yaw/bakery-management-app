<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DocComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addDocComment(Request $request){
        if($request->doc_id){
            $affectedRows = DocComments::where('id',$request->doc_id)->update([
                'doc_type' => $request->doc_type,
                'doc_number' => $request->doc_number,
                'comment' => $request->comment,
                'updated_on' => Carbon::now(),
                'updated_by' => Auth::user()->getNameOrUsername(),
            ]);

            if($affectedRows > 0){
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);
            }else{
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
        }
        
        $comment = new DocComments;

        $comment->doc_type = $request->doc_type;
        $comment->doc_number = $request->doc_number;
        $comment->comment = $request->comment;
        $comment->created_by = Auth::user()->getNameOrUsername();
		$comment->created_on = Carbon::now();

        if($comment->save())
        {
            $data = array('status' => 'success');
        }
        else
        {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);

    }

    public function getComment(Request $request){
        try {
            $comment = DocComments::where('id', $request->id)->first();
            $data = array(
                'id' => $comment->id,
                'comment' => $comment->comment,
            );
            return  Response::json($data);
            
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function deleteComment(Request $request)
    {
        if ($request->get("ID")) {
            $ID = $request->get("ID");
            $affectedRows = DocComments::where('id', '=', $ID)->delete();

            if ($affectedRows > 0) {
                $ini   = array('OK' => 'OK');
                return  Response::json($ini);
            } else {
                $ini   = array('No Data' => $ID);
                return  Response::json($ini);
            }
        } else {
            $ini   = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }
}
