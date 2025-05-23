<?php

namespace App\Livewire;

use Livewire\Component;

class UserDropdown extends Component
{
    public string $colorText = '';
    public string $bgColor = '';

    public function render()
    {
        return view('livewire.user-dropdown');
    }
}
