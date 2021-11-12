<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\ActivationMail;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\UserActivation;
use Carbon\Carbon;

use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function uploadAvatar(Request $request) {
        $user = User::find(auth('sanctum')->user()->id);
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $path = public_path() . "/storage/uploads/avatars/";
        $file->move($path, $user->id .'.jpg');
        $user->update([ 
            'avatar'=> "/storage/uploads/avatars/" .$user->id .'.jpg'
        ]);
        return response()->json('Upload successful');
     }
    public function index()
    {
        $user = User::find(auth('sanctum')->user()->id);
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendActivationMail($user)
    {
            $activation = new UserActivation;
            $token = $activation->createActivation($user);
            $email = new ActivationMail($user, $token);
            $result=Mail::to($user->email)->send($email);
            return 'Activation email has been sent';
    }

    public function resendActivationMail(Request $request)
    {
            $user=User::where('email',$request->email)->first();
            if($user->active==true) return response()->json('This email has been verified');

            return response()->json($this->sendActivationMail($user));
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name'      => 'required',
                'email' => 'email|required',
                'password' => 'required',
                'phone'     => 'digits:10|required',
            ]);
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'phone'     => $request->phone,
            ]);
            $authorizationMail=$this->sendActivationMail($user);
            return response()->json([$user,$authorizationMail]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Sign up',
                'error' => $error,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(auth('sanctum')->user()->id);
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function activateUser($token)
    {
        
        $active = UserActivation::where('token', $token)->first();
        if($active=="") {
            return response()->json('Link does not exist');
        }
        $user = User::find($active->user_id);
        $user->active = true;
        $user->save();
        $user->update(['email_verified_at' => now(),]);
        $delete=$active->deleteActivation($token);
        return response()->json(['Xác thực thành công',$delete]);
    }

    public function resetPasswordForUser(Request $request)
    {
        $passwordReset=PasswordReset::where('token', $request->token)->first();
        if($passwordReset=="") {
            return response()->json('Link does not exist');
        }
        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user=User::where('email',$passwordReset->email)->update([
            'password'=>Hash::make($request->password),
            
        ]);
        $method=$passwordReset->deletePasswordReset($request->token);
        return response()->json(['Password change successfully',$user,$method]);
    }

    public function ResetPassword(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if($user=="") return response()->json('Email does not exist');
        $Resetpassword= new PasswordReset();
        $token=$Resetpassword->createResetPassword($user);
        $email= new ResetPasswordMail($user,$token);
        Mail::to($request->email)->send($email);

        return response()->json('Password reset email has been sent');

    }
    public function usss(Request $request,$id)
    {
        $user=User::find($id);
        
        return response()->json($user);
    }
    
}
