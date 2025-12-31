<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\StudentProfile;
use App\Models\Operation;
use App\Models\AttendanceLog;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;
    public $status;
    public $first_name, $last_name, $surname, $first_name_profile, $middle_name, $suffix;
    public $student_number, $year_standing, $college, $degree_program;
    public $editing = false;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'first_name_profile' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:255',
        'student_number' => 'required|string|max:255',
        'year_standing' => 'required|string|max:255',
        'college' => 'required|string|max:255',
        'degree_program' => 'required|string|max:255',
    ];

    public function mount($userId)
    {
        $this->user = User::with('studentProfile')->findOrFail($userId);
        $this->loadData();
        $this->checkStatus();
    }

    private function loadData()
    {
        $profile = $this->user->studentProfile;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->surname = $profile->surname;
        $this->first_name_profile = $profile->first_name;
        $this->middle_name = $profile->middle_name ?? '';
        $this->suffix = $profile->suffix ?? '';
        $this->student_number = $profile->student_number;
        $this->year_standing = $profile->year_standing;
        $this->college = $profile->college;
        $this->degree_program = $profile->degree_program;
    }

    private function checkStatus()
    {
        $currentOperation = Operation::getCurrent();
        $operationId = $currentOperation ? $currentOperation->id : null;
        $this->status = ($operationId && AttendanceLog::where('user_id', $this->user->id)
            ->where('operation_id', $operationId)
            ->whereNull('log_out')
            ->exists()) ? 'Logged in' : 'Logged out';
    }

    public function toggleStatus()
    {
        $currentOperation = Operation::getCurrent();
        if ($currentOperation) {
            if ($this->status === 'Logged in') {
                // Log out
                AttendanceLog::where('user_id', $this->user->id)
                    ->where('operation_id', $currentOperation->id)
                    ->whereNull('log_out')
                    ->update(['log_out' => now()]);
            } else {
           
                AttendanceLog::create([
                    'user_id' => $this->user->id,
                    'operation_id' => $currentOperation->id,
                    'log_in' => now(),
                ]);
            }
        }
        $this->checkStatus();
        session()->flash('message', 'Status updated successfully.');
    }

    public function toggleEdit()
    {
        $this->editing = !$this->editing;
        if (!$this->editing) {
            $this->loadData(); 
        }
    }

    public function saveChanges()
    {
        $this->validate();
        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
        $this->user->studentProfile->update([
            'surname' => $this->surname,
            'first_name' => $this->first_name_profile,
            'middle_name' => $this->middle_name,
            'suffix' => $this->suffix,
            'student_number' => $this->student_number,
            'year_standing' => $this->year_standing,
            'college' => $this->college,
            'degree_program' => $this->degree_program,
        ]);
        $this->editing = false;
        session()->flash('message', 'Profile updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editing = false;
        $this->loadData(); 
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user-details');
    }
}