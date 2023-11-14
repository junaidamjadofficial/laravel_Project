<?php

namespace App\Models;

use App\Models\User;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userotherdetails extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='userotherdetails';
    protected $fillable = [
        'user_id',
        'cnic',
        'phone_no',
        'address',
    ];
    public function Users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
