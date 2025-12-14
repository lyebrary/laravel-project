<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserType;
use App\Models\StudentProfile; 
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterStudent extends Component
{

    public $surname;
    public $first_name;
    public $middle_name;
    public $suffix;
    public $username;
    public $student_number; 
    public $year_standing; 
    public $college; 
    public $degree_program; 
    public $email; 
    public $dataPrivacy = false; 

    protected $rules = [
        'surname' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'username' => 'required|string|unique:users,username|max:255',
        'student_number' => 'required|string|unique:student_profiles,student_number|max:255',
        'year_standing' => 'required|string|max:255',
        'college' => 'required|string|max:255',
        'degree_program' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email|max:255',
        'dataPrivacy' => 'accepted', 
    ];

    protected $messages = [
        'dataPrivacy.accepted' => 'You must accept the data privacy policy.',
    ];

    public function studentRegister()
    {

        $this->validate();

        $studentType = UserType::where('type_name', 'student')->first();

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->surname, 
            'username' => $this->username,
            'email' => $this->email,
            'user_type_id' => $studentType->id,
        ]);

        StudentProfile::create([
            'surname' => $this->surname,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'suffix' => $this->suffix,
            'student_number' => $this->student_number,
            'year_standing' => $this->year_standing,
            'college' => $this->college,
            'degree_program' => $this->degree_program,
            'user_id' => $user->id,
        ]);

        session()->flash('success', 'Registration successful! You can now log in.');
        $this->reset();
        return redirect()->route('welcome');
    }

    public function render()
    {
        return view('livewire.register-student');
    }
}
