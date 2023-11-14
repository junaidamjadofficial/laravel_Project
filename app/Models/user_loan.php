<?php

namespace App\Models;

use App\Models\User;
use App\Models\Loan_plan;
use App\Models\loan_user;
use App\Models\user_loan_charges;
use App\Models\user_loan_installment;
use App\Models\user_loan_transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user_loan extends Model
{
    use HasFactory;
    protected $table='user_loans';
    protected $fillable=[
    'id',
    'user_id',
    'loan_plan_id',
    'phone_no',
    'amount',
    'status',];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function loan_user(){
        return $this->belongsTo(Loan_user::class,'phone_no','phone_no');
    }
    public function loan_plan(){
        return $this->belongsTo(Loan_plan::class,'loan_plan_id');
    }
    public function user_loan_installment(){
        return $this->hasone(user_loan_installment::class,'user_loan_id'); 
    }
    public function user_loan_transaction(){
        return $this->hasone(user_loan_transaction::class,'user_loan_id'); 
    }
    public function user_loan_charges(){
        return $this->hasone(user_loan_charges::class,'user_loan_id'); 
    }
    
}
