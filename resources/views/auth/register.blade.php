@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form id="registernew" method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            
                                

                                <!-- email input -->
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

                                <!-- password input -->
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

                                <!-- confirm password -->
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    
                                </div>
                            <div id="volinfo">
                                <!-- first name input -->
                                <div class="row mb-3">
                                    <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" autofocus>

                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- last name input -->
                                <div class="row mb-3">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus>

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- shirt size -->
                                <div class="row mb-3">
                                    <label for="shirt" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-select" id=shirt>
                                            <option selected>--</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- group attribute section -->
                            <div class="row mb-3">
                                <!-- is group? checkbox to enable/disable group size field -->
                                <label for="isgroup" class="col-md-4 col-form-label text-md-end">{{ __('Check box to register as a group.') }}</label>
                                <div class=col-md-1>
                                    <input id="isgroup" name="isgroup" type="checkbox" value="yes">
                                </div>

                                <!-- enter # of members. read by js and will add fields corresponding to # of members in grp. -->
                                <div class="col-md-4">
                                    <select class="form-select" id=group_size disabled>
                                        <option selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>

                                    </select>
                                    <label for="group_size" class="form-label">How many in group?</label>
                                </div>
                            </div>
                            
                            <!-- EXTRA VOL INPUTS WILL BE ADDED HERE! -->
                            <div class="row mb-3" id="container">

                            </div>

                            <!-- waiver sign section -->
                            <div class="row mb-3">
                                <!-- check have read waiver -->
                                <label for="waiver" class="col-md-4 col-form-label text-md-end">{{ __('I have read and agree to the waiver.') }}</label>
                                <div class=col-md-1>
                                    <input name="waiver" type="checkbox" value="yes" required>
                                </div>
                                
                                <!-- signed by input -->
                                <div class="col-md-4">
                                    <input id="signature" type="text" class="form-control" name="group size" required>
                                    <label for="signature" class="form-label">Signature</label>
                                </div>
                            </div>

                            
                            <div class="row mb-3 ">
                                <div class="col-md-6 offset-md-3">                          
                                    <a class="nav-link" href="{{route('view-waiver')}}" target=_blank>{{ __('Click here to review the volunteer waiver.') }}</a>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-10 offset-md-1">
                                    <label for="comments">Additional Comments (optional):</label>
                                    <textarea class="form-control" id="comments" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-5">
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

    @prepend('js')
       @vite(['resources/js/register.js'])   
    @endprepend

@endsection
