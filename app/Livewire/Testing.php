<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Testing extends Component
{
    public $remainingTime = 10;

    #[Layout('layouts.admin.login', ['headerTitle' => 'Recovery Your Account']), Title('Control Panel - Recovery Password')]
    public function render()
    {
        return view('livewire.testing');
    }

    public function decrementTimer()
    {
        if ($this->remainingTime > 0) {
            $this->remainingTime--;
        }
    }
}
