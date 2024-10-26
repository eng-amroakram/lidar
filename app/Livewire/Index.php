<?php

namespace App\Livewire;

use Livewire\Component;

class Index extends Component
{
    public $otp = false;

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->otp = $user->email_verified_at ? false : true;
        }
    }

    public function render()
    {
        return view('livewire.index');
    }
}
