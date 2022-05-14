<?php

use http\Env\Response;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // fungsi register
    function register (Request $request){
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|digits:10|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $now = new \DateTime();
        $ctime = $now->format('Y-m-d H:i:s');
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => bcrypt($request->password),
            'created_at' => $ctime,
            'status_id' => 1,
        ]);
        return Response()->json(['status' => 'success', 'message' => 'Successful..!']);
    }

    // fungsi login
    function login (Request $request){
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'status_id' => 1))) {
                $userDetails = array(
                    'user_id' => Auth::id(),
                    'name' => Auth::User()->name,
                    'email' => Auth::User()->email,
                    'mobile_number' => Auth::User()->mobile_number,
                );
            return Response()->json(['status' => 'success', 'message' => 'Successful..!', 'userDetails' => $userDetails]);
        }else{
            return Response()->json(['status' => 'failure', 'message' => 'Invalid username or password']);
        }
    }
}
