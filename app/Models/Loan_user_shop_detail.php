<?php

namespace App\Models;

use App\Models\Loan_user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_user_shop_detail extends Model
{
    use HasFactory;
    protected $fillable=[
    'loan_user_id',
    'shop_name',
    'shop_address',
    'shop_width',
    'shop_length',
    'pop_code',
    'shop_status',
    ];
    public function Loan_user(){
        return $this->belongsTo(Loan_user::class,'loan_user_id');
    }
}
