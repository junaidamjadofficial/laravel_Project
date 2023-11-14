<?php

namespace App\Http\Controllers\api;

use App\Models\City;
use App\Models\User;
use App\Models\Loan_user;
use App\Models\Loan_plan;
use App\Models\user_loan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan_users=loan_user::orderby('id','DESC')->paginate(5);
 
        return view('Loan_User_profile.index',compact('loan_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'Owner_name' =>'required|max:255',
            'cnic' => 'required|not_regex:/-/|max:13|unique:loan_users|min:13',
            'phone_no' => 'required|unique:loan_users|starts_with:92|not_regex:/-/|max:12|min:12',
            'Owner_address' =>'required',
            'dob' =>'required',
            'cnic_issuance_date' =>'required',
            'father_name' => 'required',
            'Mother_name' => 'required',
            'consumer_type' => 'required',
            'shop_address' =>'required|unique:loan_user_shop_details',
            'shop_width' =>'required',
            'shop_length' => 'required',
            'shop_name' => 'required|max:255',
            'pop_code' => 'required',
            'shop_status'=>'required',
            'remarks'=>'required',
        ]);
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        try {
            $loan_user=Loan_user::create($request->all());
            $loan_user->Loan_user_other_detail()->create([
                'father_name' =>$request->father_name,
                'Mother_name' =>$request->Mother_name,
                'Owner_address' => $request->Owner_address,
                'dob'=>$request->dob,
                'cnic_issuance_date' => $request->cnic_issuance_date,
                'consumer_type' => $request->consumer_type,
                'remarks'=>$request->remarks,
            ]);     
            $loan_user->Loan_user_shop_detail()->create([
                'shop_address' => $request->shop_address,
                'shop_width' =>   $request->shop_width,
                'shop_length' => $request->shop_length,
                'shop_name' => $request->shop_name,
                'pop_code' => $request->pop_code,
                'shop_status'=>$request->shop_status,
            ]);    
        } catch (\Exception $e) {
            // Log the error message
            dd($e->getMessage());
        }
  
      
        return response()->json([
            // 'token' => $token,
            'user' => $loan_user,
            'message' => 'Loan User has been created Sucessfully',
            'status' =>'1',
        ]);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function show($id)
    {
        $loanUser = Loan_user::with(['user', 'city', 'Loan_user_other_detail','Loan_user_shop_detail'])->find($id);
        return response()->json(['data' => $loanUser], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan_users=Loan_user::find($id);
        // dd($loan_users);
        $users=User::all();
        $cities=City::all();
        return view('Loan_User_profile.edit',compact('loan_users','users','cities'));
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
        $loan_user=Loan_user::find($id);
        $validator=Validator::make($request->all(),[
            'Owner_name' =>'required|max:255',
            'cnic' => 'required|not_regex:/-/|max:13|min:13',
            'phone_no' => ['required', 'starts_with:92','not_regex:/-/','max:12','min:12'],
            'credit_limit' => 'required',
            'Owner_address' =>'required',
            'dob' =>'required',
            'cnic_issuance_date' =>'required',
            'father_name' => 'required',
            'Mother_name' => 'required',
            'consumer_type' => 'required',
            'shop_address' =>'required',
            'shop_width' =>'required',
            'shop_length' => 'required',
            'shop_name' => 'required|max:255',
            'pop_code' => 'required',
            'shop_status'=>'required',
            'remarks'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        try {
            
            $loan_user->fill($request->post())->save();
            // dd($loan_user);
            $loan_user->Loan_user_other_detail()->update([
                'father_name' =>$request->father_name,
                'Mother_name' =>$request->Mother_name,
                'Owner_address' => $request->Owner_address,
                'dob'=>$request->dob,
                'cnic_issuance_date' => $request->cnic_issuance_date,
                'consumer_type' => $request->consumer_type,
                'remarks'=>$request->remarks,
            ]);
            $loan_user->Loan_user_shop_detail()->update([
                'shop_address' => $request->shop_address,
                'shop_width' =>   $request->shop_width,
                'shop_length' => $request->shop_length,
                'shop_name' => $request->shop_name,
                'pop_code' => $request->pop_code,
                'shop_status'=>$request->shop_status,
            ]);
        } catch (\Exception $e) {
            // Log the error message
            dd($e->getMessage());
        }
   
        return redirect()->route('Loan_User_profile.index')->with('success','Loan User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan_users=Loan_user::find($id);
        $loan_users->delete();
        return redirect()->route('Loan_User_profile.index')->with('success','Loan User has been deleted');
    }
    // Assuming you're inside a function in a controller
    public function credit_limit(Request $request)
    {
        // Validation rules for cnic and phone_no
        $validationRules = [
            'cnic' => 'required|not_regex:/-/|max:13|min:13',
            'phone_no' => ['required', 'starts_with:92','not_regex:/-/','max:12','min:12'],
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $validationRules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Validated data
        $cnic = $request->input('cnic');
        $phoneNo = $request->input('phone_no');

        // Search for the Loan_user and retrieve credit_limit
        $loanUser = Loan_user::where('cnic', $cnic)
            ->  where('phone_no', $phoneNo)
            ->first();

        if ($loanUser) {
            // User found based on cnic and phone_no
            $creditLimit = $loanUser->credit_limit;

            return response()->json(['message'=>'User found','User'=>$loanUser->Owner_name,
            'credit_limit' => $creditLimit], 200);
        } else {
            // User not found
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function charges_calculate(Request $request) {
        // Validation rules for phone_no, loan_plan_id, and amount
        $validationRules = [
            'phone_no' => ['required', 'starts_with:92','not_regex:/-/','max:12','min:12'],
            'loan_plan_id' => 'required',
            'amount' => 'required',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $validationRules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
    
        // Validated data
        $phoneNo = $request->input('phone_no');
        $loanUser = Loan_user::where('phone_no', $phoneNo)->first();
    
        if ($loanUser) {
            // User found based on phone_no
            $creditLimit = $loanUser->credit_limit;
            $amount = $request->input('amount');
            
            if ($creditLimit >= $amount) {
                $loan_plan = Loan_plan::where('id', $request->input('loan_plan_id'))->first();
                $amount_calculate = $amount * (($loan_plan->charges) / 100);
                return $amount_calculate; // Return the calculated charges as a numeric value
            } else {
                return response()->json(['message' => 'Acquiring amount is more than credit limit', 'User' => $loanUser->Owner_name, 'Credit_limit' => $creditLimit], 200);
            }
        } else {
            // User not found
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
    public function apply_loan(Request $request) {
        $validationRules = [
            'phone_no' => ['required', 'starts_with:92','not_regex:/-/','max:12','min:12'],
            'user_id' => 'required',
            'loan_plan_id' => 'required',
            'amount' => 'required',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $validationRules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
    
        $phoneNo = $request->input('phone_no');
        $loanUser = Loan_user::where('phone_no', $phoneNo)->first();
       
        $Loan_plan_id = $request->input('loan_plan_id');
        $loan_plan = Loan_plan::where('id', $Loan_plan_id)->first();
        $ServiceCharges=$loan_plan->charges;
        if ($loanUser) {
            $creditLimit = $loanUser->credit_limit;
            $requestedAmount = $request->input('amount');
    
            if ($requestedAmount <= $creditLimit) {
                    $userLoan = new user_loan();
                    $userLoan->user_id = $request->input('user_id');
                    $userLoan->loan_plan_id = $request->input('loan_plan_id');
                    $userLoan->phone_no = $phoneNo;
                    $userLoan->amount = $requestedAmount;
                    $userLoan->status = $request->input('status');
                    $userLoan->save();
                    
                    $chargesAmount = $this->charges_calculate($request);
                    $userLoan->user_loan_installment()->create([
                        'amount' => $requestedAmount+($requestedAmount * $ServiceCharges) / 100,
                        'Outstanding' => (($requestedAmount * $ServiceCharges) / 100)                                                                           
                    ]);
        
                    // Calculate charges and store them in the user_loan_charges table
                    $userLoan->user_loan_charges()->create([
                        'loan_plan_id' => $userLoan->loan_plan_id,
                        'charges_amount' => $chargesAmount,
                        'Outstanding' => (($requestedAmount * $ServiceCharges) / 100),
                        'Amount_disperse' => $requestedAmount,
                    ]);
        
                    $userLoan->user_loan_transaction()->create([
                        'amount' => $requestedAmount,
                    ]);
                    
                    if ($userLoan->user_loan_transaction->type === 'disbursement') {
                        $newCreditLimit = $creditLimit - $requestedAmount; // Increase the credit limit
                        $loanUser->update(['credit_limit' => $newCreditLimit]);
                    }
                                    
                return response()->json(['success' => 'Loan application accepted', 'new_credit_limit' => $newCreditLimit], 200);
            } else {
                return response()->json(['error' => 'Requested loan amount exceeds credit limit'], 422);
            }
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
    
}
