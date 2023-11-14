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
            <div class="h4">Edit Loan User Profile</div>
            <div>
                <a href="{{ route('Loan_User_profile.index') }}" class="btn btn-primary">back</a>
            </div>
        </div>
        <form action="{{ route('Loan_User_profile.update', $loan_users->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">Loan User Edit Page</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="Owner_name" class="form-label">Owner Name</label>
                        <input type="text" name="Owner_name" id="Owner_name"
                            class="form-control @error('Owner_name')
                                    is-invalid
                                @enderror"
                            value="{{ old('Owner_name', $loan_users->Owner_name) }}"
                            placeholder="Enter your Owner name">
                        @error('Owner_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="BDO">BDO</label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('BDO', $loan_users->user->id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="city_id">Territory</label>
                        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror"
                            required>

                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ old('city_id', $loan_users->city->id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="cnic">CNIC</label>
                        <input type="text" name="cnic" id="cnic"
                            class="form-control @error('cnic')
                                    is-invalid
                                     @enderror"
                            value="{{ old('cnic', $loan_users->cnic) }}" placeholder="Enter your cnic number">
                        @error('cnic')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone_no">Contact</label>
                        <input type="text" name="phone_no" id="phone_no"
                            class="form-control @error('phone_no')
                                    is-invalid
                                 @enderror"
                            value="{{ old('phone_no', $loan_users->phone_no) }}"
                            placeholder="Enter your phone_no number">
                        @error('phone_no')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="credit_limit">Credit Limit</label>
                        <input type="number" name="credit_limit" id="credit_limit"
                            class="form-control @error('credit_limit')
                                    is-invalid
                                 @enderror"
                            value="{{ old('credit_limit', $loan_users->credit_limit) }}"
                            placeholder="Enter your credit_limit number">
                        @error('credit_limit')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Owner_address">Owner Address</label>
                        <textarea name="Owner_address" id="Owner_address" cols="30" rows="2" class="form-control @error('Owner_address') is-invalid @enderror">{{ old('address', $loan_users->Loan_user_other_detail->Owner_address) }}</textarea>
                        @error('Owner_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <input type="dob" name="dob" id="dob"
                            class="form-control @error('dob')
                                is-invalid
                                @enderror"
                            value="{{ old('dob', $loan_users->Loan_user_other_detail->dob) }}">
                        @error('dob')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="cnic_issuance_date">Cnic Issunace Date</label>
                        <input type="date" name="cnic_issuance_date" id="cnic_issuance_date"
                            class="form-control @error('cnic_issuance_date')
                                is-invalid
                                @enderror"
                            value="{{ old('cnic_issuance_date', $loan_users->Loan_user_other_detail->cnic_issuance_date) }}">
                        @error('cnic_issuance_date')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="father_name" class="form-label">Father Name</label>
                        <input type="text" name="father_name" id="father_name"
                            class="form-control @error('father_name')
                                    is-invalid
                                @enderror"
                            value="{{ old('father_name', $loan_users->Loan_user_other_detail->father_name) }}"
                            placeholder="Enter the father name">
                        @error('father_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Mother_name" class="form-label">Mother_name</label>
                        <input type="text" name="Mother_name" id="Mother_name"
                            class="form-control @error('Mother_name')
                                    is-invalid
                                @enderror"
                            value="{{ old('Mother_name', $loan_users->Loan_user_other_detail->Mother_name) }}"
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
                            value="{{ old('consumer_type', $loan_users->Loan_user_other_detail->consumer_type) }}"
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
                            value="{{ old('remarks', $loan_users->Loan_user_other_detail->remarks) }}"
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
                            value="{{ old('shop_name', $loan_users->Loan_user_shop_detail->shop_name) }}"
                            placeholder="Enter your shop name">
                        @error('shop_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="shop_address">shop Address</label>
                        <textarea name="shop_address" id="shop_address" cols="30" rows="2" class="form-control @error('shop_address') is-invalid @enderror">{{ old('address', $loan_users->Loan_user_shop_detail->shop_address) }}</textarea>
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
                            value="{{ old('shop_length', $loan_users->Loan_user_shop_detail->shop_length) }}"
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
                            value="{{ old('shop_width', $loan_users->Loan_user_shop_detail->shop_width) }}"
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
                            value="{{ old('pop_code', $loan_users->Loan_user_shop_detail->pop_code) }}"
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
                            value="{{ old('shop_status', $loan_users->Loan_user_shop_detail->shop_status) }}"
                            placeholder="Enter your POP code">
                        @error('shop_status')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Update Loan User" class="mt-2 btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
