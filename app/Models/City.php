<?php

namespace App\Models;

use App\Models\Loan_user;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='cities';
    public function Loan_user(){
        return $this->hasone(Loan_user::class,'city_id');
    }
}
