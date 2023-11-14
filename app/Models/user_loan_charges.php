<?php

namespace App\Models;

use App\Models\user_loan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_loan_charges extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'id',
        'user_loan_id',
        'loan_plan_id',
        'charges_amount',
        'fed',
        'Outstanding',
        'Amount_disperse',
        'Paid_date',
    ];
    public function user_loan(){
        return $this->belongsTo(user_loan::class,'user_loan_id');
    }
    public function loan_plan(){
        return $this->belongsTo(Loan_plan::class,'loan_plan_id');
    }
}
