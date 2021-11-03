<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected function getToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    public function createResetPassword($user)
    {

        $activation = PasswordReset::where('email',$user->email)->first();

        if ($activation=="") {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        PasswordReset::where('email', $user->email)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        PasswordReset::insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function getPasswordResetByEmail($user)
    {
        return PasswordReset::where('email', $user->email)->first();
    }

    public function getPasswordResetByToken($token)
    {
        return PasswordReset::where('token', $token)->first();
    }

    public function deletePasswordReset($token)
    {
        PasswordReset::where('token', $token)->delete();
    }
}
