<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="d-flex py-3 justify-content-between">
            <div class="h4">Edit User Loan Profile</div>
            <div>
                <a href="{{ route('User_loan_profile.index') }}" class="btn btn-primary">back</a>
            </div>
        </div>
        <form action="{{ route('User_loan_profile.update', $user_loans->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">Edit User Loan page</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="phone_no" class="form-label">Contact</label>
                        <input type="text" name="phone_no" id="phone_no"
                            class="form-control @error('phone_no')
                                    is-invalid
                                @enderror"
                            value="{{ old('phone_no', $user_loans->phone_no) }}"
                            placeholder="Enter your Owner name">
                        @error('phone_no')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="BDO">BDO</label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('BDO', $user_loans->user->id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="loan_plan_id">Loan_plan</label>
                        <select name="loan_plan_id" id="loan_plan_id" class="form-select @error('loan_plan_id') is-invalid @enderror" required>
                            @foreach ($loan_plans as $loan_plan)
                                <option value="{{ $loan_plan->id }}" {{ old('loan_plan_id', isset($user_loans) ? $user_loans->loan_plan->id : '') == $loan_plan->id ? 'selected' : '' }}>
                                    {{ $loan_plan->loan_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('loan_plan_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    
                    <div class="mb-3">
                        <label class="form-label" for="amount">Amount</label>
                        <input type="number" name="amount" id="amount"
                            class="form-control @error('amount')
                                    is-invalid
                                 @enderror"
                            value="{{ old('amount', $user_loans->amount) }}"
                            placeholder="Enter your amount number">
                        @error('amount')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    
                     <div class="mb-3">
                        <label class="form-label" for="due_date">Installments Due Date</label>
                        <input type="due_date" name="due_date" id="due_date"
                            class="form-control @error('due_date')
                                is-invalid
                                @enderror"
                            value="{{ old('due_date', $user_loans->user_loan_installment->due_date) }}">
                        @error('due_date')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="paid_date">Installment Paid Date</label>
                        <input type="date" name="paid_date" id="paid_date"
                            class="form-control @error('paid_date')
                                is-invalid
                                @enderror"
                            value="{{ old('paid_date', $user_loans->user_loan_installment->paid_date) }}">
                        @error('paid_date')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="amount"> installment Amount</label>
                        <input type="number" name="amount" id="amount"
                            class="form-control @error('amount')
                                    is-invalid
                                 @enderror"
                            value="{{ old('amount', $user_loans->user_loan_installment->amount) }}"
                            placeholder="Enter your amount number">
                        @error('amount')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="charges_amount"> charges_amount</label>
                        <input type="number" name="charges_amount" id="charges_amount"
                            class="form-control @error('charges_amount')
                                    is-invalid
                                 @enderror"
                            value="{{ old('charges_amount', $user_loans->user_loan_charges->charges_amount) }}"
                            placeholder="Enter your charges_amount number">
                        @error('charges_amount')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fed"> fed</label>
                        <input type="number" name="fed" id="fed"
                            class="form-control @error('fed')
                                    is-invalid
                                 @enderror"
                            value="{{ old('fed', $user_loans->user_loan_charges->fed) }}"
                            placeholder="Enter your fed number">
                        @error('fed')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="amount">Transaction amount</label>
                        <input type="number" name="amount" id="amount"
                            class="form-control @error('amount')
                                    is-invalid
                                 @enderror"
                            value="{{ old('amount', $user_loans->user_loan_transaction->amount) }}"
                            placeholder="Enter your amount number">
                        @error('amount')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Transaction Type</label>
                        <input type="text" name="type" id="type"
                            class="form-control @error('type')
                                    is-invalid
                                @enderror"
                            value="{{ old('type', $user_loans->user_loan_transaction->type) }}"
                            placeholder="Enter the Transaction type">
                        @error('type')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    {{--<div class="mb-3">
                        <label for="Mother_name" class="form-label">Mother_name</label>
                        <input type="text" name="Mother_name" id="Mother_name"
                            class="form-control @error('Mother_name')
                                    is-invalid
                                @enderror"
                            value="{{ old('Mother_name', $user_loans->Loan_user_other_detail->Mother_name) }}"
                            placeholder="Enter the Mother name">
                        @error('Mother_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="consumer_type" class="form-label">consumer_type</label>
                        <input type="text" name="consumer_type" id="consumer_type"
                            class="form-control @error('consumer_type')
                                    is-invalid
                                @enderror"
                            value="{{ old('consumer_type', $user_loans->Loan_user_other_detail->consumer_type) }}"
                            placeholder="Enter the Mother name">
                        @error('consumer_type')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">remarks</label>
                        <input type="text" name="remarks" id="remarks"
                            class="form-control @error('remarks')
                                    is-invalid
                                @enderror"
                            value="{{ old('remarks', $user_loans->Loan_user_other_detail->remarks) }}"
                            placeholder="Enter the Mother name">
                        @error('remarks')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="shop_name" class="form-label">shop Name</label>
                        <input type="text" name="shop_name" id="shop_name"
                            class="form-control @error('shop_name')
                                    is-invalid
                                @enderror"
                            value="{{ old('shop_name', $user_loans->Loan_user_shop_detail->shop_name) }}"
                            placeholder="Enter your shop name">
                        @error('shop_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="shop_address">shop Address</label>
                        <textarea name="shop_address" id="shop_address" cols="30" rows="2" class="form-control @error('shop_address') is-invalid @enderror">{{ old('address', $user_loans->Loan_user_shop_detail->shop_address) }}</textarea>
                        @error('shop_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="shop_length" class="form-label">shop length</label>
                        <input type="number" name="shop_length" id="shop_length"
                            class="form-control @error('shop_length')
                                    is-invalid
                                @enderror"
                            value="{{ old('shop_length', $user_loans->Loan_user_shop_detail->shop_length) }}"
                            placeholder="Enter your shop length">
                        @error('shop_length')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="shop_width" class="form-label">shop width</label>
                        <input type="number" name="shop_width" id="shop_width"
                            class="form-control @error('shop_width')
                                    is-invalid
                                @enderror"
                            value="{{ old('shop_width', $user_loans->Loan_user_shop_detail->shop_width) }}"
                            placeholder="Enter your shop width">
                        @error('shop_width')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pop_code" class="form-label">POP Code</label>
                        <input type="text" name="pop_code" id="pop_code"
                            class="form-control @error('pop_code')
                                    is-invalid
                                @enderror"
                            value="{{ old('pop_code', $user_loans->Loan_user_shop_detail->pop_code) }}"
                            placeholder="Enter your POP code">
                        @error('pop_code')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="shop_status" class="form-label">shop Status</label>
                        <input type="text" name="shop_status" id="shop_status"
                            class="form-control @error('shop_status')
                                    is-invalid
                                @enderror"
                            value="{{ old('shop_status', $user_loans->Loan_user_shop_detail->shop_status) }}"
                            placeholder="Enter your POP code">
                        @error('shop_status')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    <input type="submit" value="Update Loan User" class="mt-2 btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
