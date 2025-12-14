<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserType;
use App\Models\StudentProfiles;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterStudent extends Component
{
    // Public properties for form binding
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

    // Validation rules
    protected $rules = [
        'surname' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'username' => 'required|string|unique:users,username|max:255',
        'student_number' => 'required|string|unique:users,student_number|max:255',
        'year_standing' => 'required|string|max:255',
        'college' => 'required|string|max:255',
        'degree_program' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email|max:255',
        'dataPrivacy' => 'accepted', 
    ];

    // Custom error messages (optional)
    protected $messages = [
        'dataPrivacy.accepted' => 'You must accept the data privacy policy.',
    ];

    // Method to handle form submission
    public function studentRegister()
    {
        // Validate inputs
        $this->validate();

        // Get the 'student' user type
        $studentType = UserType::where('type_name', 'student')->first();
        if (!$studentType) {
            $this->addError('general', 'Student user type not found. Please seed the database.');
            return;
        }

        
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->surname, 
            'student_number' => $this->student_number,
            'username' => $this->username,
            'email' => $this->email,
            'user_type_id' => $studentType->id,
        ]);

        StudentProfiles::create([
            'surname' => $this->surname,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'suffix' => $this->suffix,
            'year_standing' => $this->year_standing,
            'college' => $this->college,
            'degree_program' => $this->degree_program,
            'user_id' => $user->id,
        ]);

        session()->flash('success', 'Registration successful! You can now log in.');
        $this->reset();
        return redirect()->route('welcome');
    }

    // Render the view
    public function render()
    {
        return view('livewire.register-student');
    }
}
