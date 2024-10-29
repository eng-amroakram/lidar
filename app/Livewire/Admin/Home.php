<?php

namespace App\Livewire\Admin;

use App\Models\Meeting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public $search = '';
    public $pagination = 10;

    #[Layout('layouts.admin.app'), Title('Control Panel - Home')]
    public function render()
    {
        $meetings = Meeting::paginate($this->pagination);
        return view('livewire.admin.home', compact(['meetings']));
    }
}
