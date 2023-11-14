<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Loan_plan;
use App\Models\user_loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class User_Loan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_loans = user_loan::with('loan_user')->orderBy('id', 'DESC')->paginate(5);
        return view('User_loan_profile.index', compact('user_loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
        $userLoan = user_loan::with('user_loan_transaction','user_loan_installment','user_loan_charges','loan_plan','user','loan_user')->find($id);
        return response()->json(['data' => $userLoan], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_loans=user_loan::find($id);
        $users=User::all();
        $loan_plans=Loan_plan::all();
        return view('User_loan_profile.edit',compact('user_loans','users','loan_plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_loans=user_loan::find($id);
        $user_loans->delete();
        return redirect()->route('User_loan_profile.index')->with('success','Loan User has been deleted');
    }
}
