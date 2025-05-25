<?php

namespace App\Livewire;

use Livewire\Component;

class UserDropdown extends Component
{
    public string $colorText;   // declara la propiedad

    public function mount(string $colorText)
    {
        $this->colorText = $colorText;
    }
    
    public function render()
    {
        return view('livewire.user-dropdown');
    }
}
