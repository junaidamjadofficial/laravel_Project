<?php

namespace App\Models;

use App\Models\Loan_user;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan_user_other_detail extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='loan_user_other_details';
    protected $fillable=[ 
    'loan_user_id',
    'Owner_address',
    'dob',
    'cnic_issuance_date',
    'father_name',
    'Mother_name',
    'consumer_type',
    'remarks',
    ];  
    public function Loan_user(){
        return $this->belongsTo(Loan_user::class,'loan_user_id');
    }
    
}