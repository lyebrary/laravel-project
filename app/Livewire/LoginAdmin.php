<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginAdmin extends Component
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'username.required' => 'Username is required.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            $user = Auth::user();
            if ($user->userType && $user->userType->type_name === 'admin') {
                session()->flash('success', 'Welcome back, Admin!');
                return redirect()->route('manage-logs'); 
            } else {
                Auth::logout();
                $this->addError('general', 'Access denied. This login is for admins only.');
                return;
            }
        } else {
            $this->addError('general', 'Invalid username or password.');
        }
    }

    public function render()
    {
        return view('livewire.login-admin');
    }
}