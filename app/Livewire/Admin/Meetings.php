<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Meetings extends Component
{
    #[Layout('layouts.admin.app'), Title('Control Panel - Meetings')]
    public function render()
    {
        return view('livewire.admin.meetings');
    }
}
