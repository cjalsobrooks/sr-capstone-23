@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
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

                        <!-- group attribute section -->
                        <div class="row mb-3">
                            <!-- is group? checkbox to enable/disable group size field -->
                            <label for="group-size" class="col-md-4 col-form-label text-md-end">{{ __('Group?:') }}</label>
                            <div class=col-md-1>
                                <input name="isgroup" type="checkbox" value="yes">
                            </div>

                            <!-- enter # of members. read by js and will add fields corresponding to # of members in grp. -->
                            <div class="col-md-4">
                                <input id="group_size" type="number" class="form-control" name="group size" min="1" max="10">
                                <label for="group_size" class="form-label">How many?</label>

                                <!-- <input id="toggle-event" type="checkbox" data-toggle="toggle">
                                <div id="console-event"></div>
                                <script>
                                    $(function() {
                                        $('#toggle-event').change(function() {
                                        $('#console-event').html('Toggle: ' + $(this).prop('checked'))
                                        })
                                    })
                                </script> -->
                            </div>
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
                            <div class="col-md-6 offset-md-5">                          
                                <a class="nav-link" href="{{route('view-waiver')}}" target=_blank>{{ __('Click to view waiver.') }}</a>
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
@endsection
