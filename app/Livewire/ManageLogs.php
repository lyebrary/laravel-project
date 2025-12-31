<?php

namespace App\Livewire;

use App\Models\AttendanceLog;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\AdminProfile;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ManageLogs extends Component
{
    use WithPagination;

    public $selectedDate;
    public $startTime;
    public $endTime;
    public $page = 1; 

    protected $queryString = ['selectedDate', 'startTime', 'endTime'];

    public function mount()
    {
        $this->selectedDate = Carbon::now('Asia/Manila')->toDateString();
        $this->startTime = null;
        $this->endTime = null;
        $this->page = 1;  
    }

    public function updatedSelectedDate()
    {
        $this->resetPage();
        $this->page = 1;
    }

    public function updatedStartTime()
    {
        $this->resetPage();
        $this->page = 1;
    }

    public function updatedEndTime()
    {
        $this->resetPage();
        $this->page = 1;
    }

    public function render()
    {
        // Fetch all logs (remove date/time filters from query)
        $logs = AttendanceLog::with(['user'])->get();

        $actions = collect();

        foreach ($logs as $log) {
            $userName = $this->getUserName($log->user);
            $studentNumber = $this->getStudentNumber($log->user);

            if ($log->log_in) {
                $timestamp = Carbon::parse($log->log_in)->setTimezone('Asia/Manila');
                $actions->push([
                    'id' => $log->id,
                    'user_name' => $userName,
                    'student_number' => $studentNumber,
                    'action' => 'Log In',
                    'date' => $timestamp->format('m-d-y'),
                    'time' => $timestamp->format('g:i A'),
                    'timestamp' => $timestamp,
                ]);
            }

            if ($log->log_out) {
                $timestamp = Carbon::parse($log->log_out)->setTimezone('Asia/Manila');
                $actions->push([
                    'id' => $log->id,
                    'user_name' => $userName,
                    'student_number' => $studentNumber,
                    'action' => 'Log Out',
                    'date' => $timestamp->format('m-d-y'),
                    'time' => $timestamp->format('g:i A'),
                    'timestamp' => $timestamp, 
                ]);
            }
        }

        // Now filter $actions by selectedDate, startTime, endTime
        $manilaDate = Carbon::createFromFormat('Y-m-d', $this->selectedDate, 'Asia/Manila');
        $actions = $actions->filter(function ($action) use ($manilaDate) {
            // Filter by date (must match selectedDate)
            $actionDate = $action['timestamp']->toDateString();
            if ($actionDate !== $this->selectedDate) {
                return false;
            }

            // Filter by startTime (if set)
            if ($this->startTime) {
                $startTime = $manilaDate->copy()->setTimeFromTimeString($this->startTime);
                if ($action['timestamp']->lt($startTime)) {
                    return false;
                }
            }

            // Filter by endTime (if set)
            if ($this->endTime) {
                $endTime = $manilaDate->copy()->setTimeFromTimeString($this->endTime);
                if ($action['timestamp']->gt($endTime)) {
                    return false;
                }
            }

            return true;
        });

        // Sort by timestamp descending
        $actions = $actions->sortByDesc('timestamp');

        // Paginate the filtered/sorted actions
        $paginatedActions = new \Illuminate\Pagination\LengthAwarePaginator(
            $actions->forPage($this->page, 15), 
            $actions->count(),                  
            15,                                 
            $this->page,                        
            ['path' => request()->url(), 'pageName' => 'page'] 
        );

        return view('livewire.manage-logs', [
            'actions' => $paginatedActions,
        ]);
    }

    private function getUserName($user)
    {
        if (!$user) return 'Unknown';

        $profile = null;
        if ($user->user_type_id == 1) { 
            $profile = StudentProfile::where('user_id', $user->id)->first();
        } elseif ($user->user_type_id == 2) { 
            $profile = AdminProfile::where('user_id', $user->id)->first();
        }

        if ($profile) {
            return $profile->surname . ', ' . $profile->first_name;
        }

        return $user->last_name . ', ' . $user->first_name;
    }

    private function getStudentNumber($user)
    {
        if (!$user || $user->user_type_id != 1) return 'N/A'; 

        $profile = StudentProfile::where('user_id', $user->id)->first();
        return $profile ? $profile->student_number : 'N/A';
    }
}