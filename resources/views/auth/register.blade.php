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
                                        <select class="form-select" id=shirt name="shirt_size">
                                            <option selected>--</option>
                                            <option value="xs">XS</option>
                                            <option value="s">S</option>
                                            <option value="m">M</option>
                                            <option value="l">L</option>
                                            <option value="xl">XL</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- age -->
                                <div class="row mb-3">
                                    <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                    <div class="col-md-4">
                                        <input id="age" type="number" class="form-control" name="age" min="1" max="120" required>
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
                                    <select name="group_size" class="form-select" id=group_size disabled>
                                        <option value="1" selected>N/A</option>
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
                            
                            <!-- EXTRA VOL INPUTS-->
                            <div id="groupinfo">

                                <div class="extra offset-md-1" id="e1" hidden>
                                <label for="e1">Volunteer 2 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname1" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname1" type="text" class="e1 form-control @error('firstname1') is-invalid @enderror" name="firstname1" value="name" autocomplete="name">

                                            @error('firstname1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname1" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname1" type="text" class="e1 form-control @error('lastname1') is-invalid @enderror" name="lastname1" value="name" autocomplete="name">

                                            @error('lastname1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt1" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e1" id=shirt1 name="shirt_size1">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age1" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age1" type="number" class="form-control e1" name="age1" min="1" max="120">
                                        </div>
                                    </div>
                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e2" hidden>
                                <label for="e2">Volunteer 3 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname2" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname2" type="text" class="e2 form-control @error('firstname2') is-invalid @enderror" name="firstname2" value="name" autocomplete="name">

                                            @error('firstname2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname2" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname2" type="text" class="e2 form-control @error('lastname2') is-invalid @enderror" name="lastname2" value="name" autocomplete="name">

                                            @error('lastname2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt2" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e2" id=shirt2 name="shirt_size2">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age2" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age2" type="number" class="form-control e2" name="age2" min="1" max="120">
                                        </div>
                                    </div>
                            
                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e3" hidden>
                                <label for="e3">Volunteer 4 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname3" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname3" type="text" class="e3 form-control @error('firstname3') is-invalid @enderror" name="firstname3" value="name " autocomplete="name">

                                            @error('firstname3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname3" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname3" type="text" class="e3 form-control @error('lastname3') is-invalid @enderror" name="lastname3" value=" name" autocomplete="name">

                                            @error('lastname3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt3" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e3" id=shirt3 name="shirt_size3">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age3" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age3" type="number" class="form-control e3" name="age3" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e4" hidden>
                                <label for="e4">Volunteer 5 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname4" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname4" type="text" class="e4 form-control @error('firstname4') is-invalid @enderror" name="firstname4" value="name " autocomplete="name">

                                            @error('firstname4')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname4" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname4" type="text" class="e4 form-control @error('lastname4') is-invalid @enderror" name="lastname4" value="name " autocomplete="name">

                                            @error('lastname4')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt4" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e4" id=shirt4 name="shirt_size4">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age4" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age4" type="number" class="form-control e4" name="age4" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e5" hidden>
                                <label for="e5">Volunteer 6 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname5" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname5" type="text" class="e5 form-control @error('firstname5') is-invalid @enderror" name="firstname5" value=" name" autocomplete="name">

                                            @error('firstname5')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname5" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname5" type="text" class="e5 form-control @error('lastname5') is-invalid @enderror" name="lastname5" value=" name" autocomplete="name">

                                            @error('lastname5')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt5" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e5" id=shirt5 name="shirt_size5">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age5" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age5" type="number" class="form-control e5" name="age5" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e6" hidden>
                                <label for="e6">Volunteer 7 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname6" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname6" type="text" class="e5 form-control @error('firstname6') is-invalid @enderror" name="firstname6" value="name " autocomplete="name">

                                            @error('firstname6')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname6" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname6" type="text" class="e5 form-control @error('lastname6') is-invalid @enderror" name="lastname6" value="name " autocomplete="name">

                                            @error('lastname6')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt6" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e5" id=shirt6 name="shirt_size6">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age6" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age6" type="number" class="form-control e6" name="age6" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e7" hidden>
                                <label for="e7">Volunteer 8 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname7" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname7" type="text" class="e7 form-control @error('firstname7') is-invalid @enderror" name="firstname7" value="name " autocomplete="name">

                                            @error('firstname7')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname7" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname7" type="text" class="e7 form-control @error('lastname7') is-invalid @enderror" name="lastname7" value="name " autocomplete="name">

                                            @error('lastname7')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt7" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e7" id=shirt7 name="shirt_size7">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age7" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age7" type="number" class="form-control e7" name="age7" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e8" hidden>
                                <label for="e8">Volunteer 9 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname8" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname8" type="text" class="e8 form-control @error('firstname8') is-invalid @enderror" name="firstname8" value="name " autocomplete="name">

                                            @error('firstname8')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname8" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname8" type="text" class="e8 form-control @error('lastname8') is-invalid @enderror" name="lastname8" value="name " autocomplete="name">

                                            @error('lastname8')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt8" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e8" id=shirt8 name="shirt_size8">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age8" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age8" type="number" class="form-control e8" name="age8" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                                <!-- ------------------------------------------------------------------------ -->

                                <div class="extra offset-md-1" id="e9" hidden>
                                <label for="e9">Volunteer 10 Info:</label>
                                    <!-- first name input -->
                                    <div class="row mb-3">
                                        <label for="firstname9" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="firstname9" type="text" class="e9 form-control @error('firstname9') is-invalid @enderror" name="firstname9" value="name " autocomplete="name">

                                            @error('firstname9')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- last name input -->
                                    <div class="row mb-3">
                                        <label for="lastname9" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="lastname9" type="text" class="e9 form-control @error('lastname9') is-invalid @enderror" name="lastname9" value="name" autocomplete="name">

                                            @error('lastname9')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- shirt size -->
                                    <div class="row mb-3">
                                        <label for="shirt9" class="col-md-4 col-form-label text-md-end">{{ __('Select T-Shirt Size:') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select e9" id=shirt9 name="shirt_size9">
                                                <option selected>--</option>
                                                <option value="xs">XS</option>
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- age -->
                                    <div class="row mb-3">
                                        <label for="age9" class="col-md-4 col-form-label text-md-end">{{ __('Age:') }}</label>
                                        <div class="col-md-4">
                                            <input id="age9" type="number" class="form-control e9" name="age9" min="1" max="120">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- waiver sign section -->
                            <div class="row mb-3">
                                <!-- check have read waiver -->
                                <label for="waiver_signed" class="col-md-4 col-form-label text-md-end">{{ __('I have read and agree to the waiver.') }}</label>
                                <div class=col-md-1>
                                    <input name="waiver_signed" type="checkbox" value="yes" required>
                                </div>
                                
                                <!-- signed by input -->
                                <div class="col-md-4">
                                    <input id="signed_by" type="text" class="form-control" name="signed_by" required>
                                    <label for="signed_by" class="form-label">Signature</label>
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
                                    <textarea class="form-control" id="comments" name="comment" rows="4"></textarea>
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
