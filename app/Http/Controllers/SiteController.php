<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{

    use PasswordValidationRules;

    public function register_employer(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),

            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'company_subdomain' => [
                'required',
                'string',
                'subdomain',
                'max:255',
                Rule::unique(Employer::class),
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->createAsStripeCustomer();

        $employer = Employer::create([
            'name' => $request->company_name,
            'subdomain' => $request->company_subdomain,
        ]);

        Profile::create([
            'type' => 'employee',
            'employer_id' => $employer->id,
            'user_id' => $user->id,
        ]);

        return view('onboarding.employer-step01');
    }

    public function register_intern(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->createAsStripeCustomer();

        Profile::create([
            'type' => 'intern',
            'user_id' => $user->id,
        ]);

        return redirect('/dashboard');
    }
}
