<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\WelcomeMail;
use App\Mail\ActivationMail;
use App\Models\UserActivation;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find( auth('sanctum')->user()->id);
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $request->validate([
                'name'      => 'required',
                'email' => 'email|required',
                'password' => 'required',
                'phone'     => 'digits:10|required',
            ]);
            $user=User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'phone'     => $request->phone,
            ]);
            $activation= new UserActivation;
            $token=$activation->createActivation($user);
            $email=new ActivationMail($user,$token);
            Mail::to($user->email)->send($email);
            return response()->json($user);
        }
        catch (\Exception $error) {
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
        return response()->json( User::find($id));
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
    public function update(Request $request,$id)
    {
        $user=User::find( auth('sanctum')->user()->id);
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
        $active=UserActivation::where('token',$token)->first();
        $user=User::find($active->user_id);
        $user->active=true;
        $user->save();
        $active->delete();
        return response()->json('Xác thực thành công');
    }
    public function usss(Request $request)
    {
        // $user=User::find(15);
        // $email= new WelcomeMail($user);
        //     $result=Mail::to($user->email)->send($email);
        //     return response()->json($email);
    }
}
