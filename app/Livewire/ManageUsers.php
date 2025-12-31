<?php

namespace App\Livewire;

use App\Models\StudentProfile;
use App\Models\AttendanceLog;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ManageUsers extends Component
{
    public $users = [];
    public $search = '';
    public $selectedUsers = [];
    public $selectAll = false;
    public $showPasswordModal = false;
    public $adminPassword = '';
    public $deleteAction = ''; 
    public $totalUsers = 0;

    protected $rules = [
        'adminPassword' => 'required|string',
    ];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $currentOperation = Operation::getCurrent();
        $operationId = $currentOperation ? $currentOperation->id : null;

        $query = StudentProfile::whereHas('user')->with('user');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('surname', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('student_number', 'like', '%' . $this->search . '%');
            });
        }

        $this->totalUsers = $query->count();

        $this->users = $query->get()
            ->map(function ($profile) use ($operationId) {
                $user = $profile->user;
                
                $isLoggedIn = $operationId && AttendanceLog::where('user_id', $user->id)
                    ->where('operation_id', $operationId)
                    ->whereNull('log_out')
                    ->exists();

                return [
                    'id' => $user->id,
                    'surname' => $profile->surname,
                    'first_name' => $profile->first_name,
                    'student_number' => $profile->student_number,
                    'college' => $profile->college,
                    'degree_program' => $profile->degree_program,
                    'registration_date' => $user->created_at->format('Y-m-d'),
                    'status' => $isLoggedIn ? 'Logged in' : 'Logged out',
                ];
            });
    }

    public function updatedSearch()
    {
        $this->loadUsers();
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedUsers = collect($this->users)->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = count($this->selectedUsers) === count($this->users);
    }

    public function logoutAll()
    {
        $currentOperation = Operation::getCurrent();
        if ($currentOperation) {
            AttendanceLog::where('operation_id', $currentOperation->id)
                ->whereNull('log_out')
                ->update(['log_out' => now()]);
        }
        $this->loadUsers();
        session()->flash('message', 'All users logged out successfully.');
    }

    public function confirmDeleteSelected()
    {
        if (empty($this->selectedUsers)) {
            session()->flash('error', 'No users selected.');
            return;
        }
        $this->deleteAction = 'selected';
        $this->showPasswordModal = true;
    }

    public function confirmDeleteAll()
    {
        $this->deleteAction = 'all';
        $this->showPasswordModal = true;
    }

    public function executeDelete()
    {
        $this->validate();

        $admin = auth()->user();
        if (!$admin || !Hash::check($this->adminPassword, $admin->password_hash)) {
            $this->addError('adminPassword', 'Incorrect password.');
            return;
        }

        if ($this->deleteAction === 'selected') {
            User::whereIn('id', $this->selectedUsers)->delete(); // Soft delete
            session()->flash('message', 'Selected users deleted successfully.');
        } elseif ($this->deleteAction === 'all') {
            User::whereHas('studentProfile')->delete();
            session()->flash('message', 'All users deleted successfully.');
        }

        $this->resetDeleteState();
        $this->loadUsers();
    }

    public function cancelDelete()
    {
        $this->resetDeleteState();
    }

    private function resetDeleteState()
    {
        $this->showPasswordModal = false;
        $this->adminPassword = '';
        $this->deleteAction = '';
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.manage-users');
    }
}