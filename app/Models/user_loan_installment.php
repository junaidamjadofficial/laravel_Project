<?php

namespace App\Models;

use App\Models\user_loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_loan_installment extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_loan_id',
        'Date',
        'due_date',
        'paid_date',
        'amount',
        'Outstanding',
        'Status',
    ];
    public function user_loan(){
        return $this->belongsTo(user_loan::class,'user_loan_id');
    }
}
