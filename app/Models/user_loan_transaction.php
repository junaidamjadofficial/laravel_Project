<?php

namespace App\Models;

use App\Models\user_loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_loan_transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_loan_id',
        'Trx_id',
        'Trx_code',
        'Trx_response',
        'rest_loan',
        'amount',
        'type',
    ];
    public function user_loan(){
        return $this->belongsTo(user_loan::class,'user_loan_id');
    }
}
