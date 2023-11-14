<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Loan_user_other_detail;
use App\Models\Loan_user_shop_detail;
use App\Models\user_loan;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan_user extends Model
{
    use HasApiTokens, HasFactory, Notifiable,HasFactory;
    protected $table='loan_users';
    protected $fillable=[
    'user_id',
    'city_id',
    'Owner_name',
    'cnic',
    'phone_no',
    'credit_limit'
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function Loan_user_other_detail(){
        return $this->hasOne( Loan_user_other_detail::class,'loan_user_id');
    }
    public function Loan_user_shop_detail(){
        return $this->hasOne( Loan_user_shop_detail::class,'loan_user_id');
    }
    public function user_loan(){
        return $this->hasOne(user_loan::class,'phone_no','phone_no');
    }
}
