<?php

namespace App\Livewire;

use Livewire\Component;

class AdminLogin extends Component
{
    public $username;
    public $password;

    public function login()
    {
        // authentication logic here
    }

    public function render()
    {
        return view('livewire.admin-login');
    }
}
