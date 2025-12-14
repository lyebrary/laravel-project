<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserType;
use App\Models\AdminProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterAdmin extends Component
{
    
    public $surname; 
    public $first_name;
    public $middle_name;
    public $suffix;
    public $username;
    public $password;
    public $dataPrivacy; 

    protected $rules = [
        'surname' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:8',
        'dataPrivacy' => 'accepted', 
    ];

    protected $messages = [
        'username.unique' => 'This username is already taken.',
        'dataPrivacy.accepted' => 'You must accept the data privacy policy.',
    ];

    public function registerAdmin()
    {
        $this->validate();

        
        $userType = UserType::firstOrCreate(
            ['type_name' => 'admin']
        );

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->surname,
            'username' => $this->username,
            'password_hash' => Hash::make($this->password),
            'user_type_id' => $userType->id,
            
        ]);

    
        AdminProfile::create([
            'first_name' => $this->first_name,
            'surname' => $this->surname,
            'middle_name' => $this->middle_name ?? '',
            'suffix' => $this->suffix,
            'user_id' => $user->id,
        ]);

        session()->flash('success', 'Admin registered successfully!');
        return redirect()->route('welcome');
    }
    public function render()
    {
        return view('livewire.register-admin');
    }
}