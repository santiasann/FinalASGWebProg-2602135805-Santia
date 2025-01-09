@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container" style="padding-top: 80px;padding-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fields_of_work" class="col-md-4 col-form-label text-md-end">{{ __('Fields of Work Interest (Min. 3)') }}</label>

                            <div class="col-md-6">
                                <div id="fields_of_work" class="form-check">
                                    <input type="checkbox" class="form-check-input" id="software_engineer" name="fields_of_work[]" value="Software Engineer" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="software_engineer">Software Engineer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="ai_engineer" name="fields_of_work[]" value="AI Engineer" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="ai_engineer">AI Engineer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="ui_engineer" name="fields_of_work[]" value="UI Engineer" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="ui_engineer">UI Engineer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="designer" name="fields_of_work[]" value="Designer" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="designer">Designer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="manager" name="fields_of_work[]" value="Manager" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="manager">Manager</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="teacher" name="fields_of_work[]" value="Teacher" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="teacher">Teacher</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="data_scientist" name="fields_of_work[]" value="Data Scientist" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="data_scientist">Data Scientist</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="marketing" name="fields_of_work[]" value="Marketing" onchange="validateCheckboxes()">
                                    <label class="form-check-label" for="marketing">Marketing</label>
                                </div>

                                @error('fields_of_work')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="linkedin_username" class="col-md-4 col-form-label text-md-end">{{ __('LinkedIn Username') }}</label>

                            <div class="col-md-6">
                                <input id="linkedin_username" type="url" class="form-control @error('linkedin_username') is-invalid @enderror" name="linkedin_username" value="{{ old('linkedin_username') }}" required autocomplete="linkedin_username">

                                @error('linkedin_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile_number" class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number">

                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Registration Fee</label>

                            <div class="col-md-6">
                                <p>
                                    <strong>$1000</strong>
                                </p>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function validateCheckboxes() {
            const checkboxes = document.querySelectorAll('input[name="fields_of_work[]"]:checked');
            const errorMessage = document.querySelector('.invalid-feedback');

            if (checkboxes.length < 3) {
                errorMessage.textContent = 'Please select at least 3 fields of work.';
                errorMessage.style.display = 'block';
            } else {
                errorMessage.textContent = '';
                errorMessage.style.display = 'none';
            }
        }
    </script>
@endsection