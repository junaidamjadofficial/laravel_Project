<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_plan extends Model
{
    use HasFactory;
    protected $table='loan_plan';
    protected $fillable=[
    'id',
    'loan_name',
    'loan_plan',
    'charges',
    ];
    public function user_loan(){
        return $this->hasone(user_loan::class,'loan_plan_id');
    }
    public function user_loan_charges(){
        return $this->hasone(user_loan_charges::class,'user_loan_id'); 
    }
}
