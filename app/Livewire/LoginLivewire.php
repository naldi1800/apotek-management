<?php

namespace App\Livewire;

use Livewire\Component;

class LoginLivewire extends Component
{

    public $role;

    public function render()
    {
        return view('livewire.login-livewire');
    }
}
