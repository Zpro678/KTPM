<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
class client extends Authenticatable
{
    //    
    
    use HasFactory;    
    protected $table = "users";
    protected $primaryKey = "id"; 
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password', 'is_active'];

    public static function GetEmailUser($request)
    {
        $data = Client::where('email','=', $request->email)->first();

        return $data ? $data : null;
    }
}
           