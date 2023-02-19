<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'shirt_size' => ['required', 'string', 'max:3'],
            'age' => ['required', 'integer', 'min:2'],
            'group_size' => ['required', 'integer', 'min:1', 'max:10'],
            'waiver_signed' => ['required', 'boolean'],
            // e1 ---- index 8
            'firstname1' => ['string', 'max:255'],
            'lastname1' => ['string', 'max:255'],
            'shirt_size1' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e2 ---- index 12
            'firstname2' => ['string', 'max:255'],
            'lastname2' => ['string', 'max:255'],
            'shirt_size2' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e3 ---- index 16
            'firstname3' => ['string', 'max:255'],
            'lastname3' => ['string', 'max:255'],
            'shirt_size3' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e4 ---- index 20
            'firstname4' => ['string', 'max:255'],
            'lastname4' => ['string', 'max:255'],
            'shirt_size4' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e5 ---- index 24
            'firstname5' => ['string', 'max:255'],
            'lastname5' => ['string', 'max:255'],
            'shirt_size5' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e6 ---- index 28
            'firstname6' => ['string', 'max:255'],
            'lastname6' => ['string', 'max:255'],
            'shirt_size6' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e7 ---- index 32
            'firstname7' => ['string', 'max:255'],
            'lastname7' => ['string', 'max:255'],
            'shirt_size7' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e8 ---- index 36
            'firstname8' => ['string', 'max:255'],
            'lastname8' => ['string', 'max:255'],
            'shirt_size8' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],
            // e9 ---- index 40 
            'firstname8' => ['string', 'max:255'],
            'lastname8' => ['string', 'max:255'],
            'shirt_size8' => ['string', 'max:3'],
            'age1' => ['string', 'max:3'],           
            //signed by
            'signed_by' => ['required', 'string', 'max: 255'],
            'comment' => ['string', 'max: 255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'group_size' => $data['group_size'],
        ]);

        Volunteer::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'shirt_size' => $data->shirt_size,  
            'age' => $data->age,
            'is_waiver_signed' => $data->waiver_signed,
            'waiver_signed_by' => $data->signed_by,
            'comment' => $data->comment,        
        ]);
 
        for ($i = 0; $i < $data['group_size']; $i++) {

            $fn = 4 * $i;
            $ln = 4 * $i + 1;
            $shirt = 4 * $i + 2;
            $a = 4 * $i + 3; 

            Volunteer::create([
                'user_id' => $user->id,
                'first_name' => $data[$fn],
                'last_name' => $data[$ln],
                'shirt_size' => $data[$shirt],
                'age' => $data[$a],
                'is_waiver_signed' => $data->waiver_signed,
                'waiver_signed_by' => $data->signed_by,
                'comment' => $data->comment,           
            ]);
        }
        return $user;
    }
}
