<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconoRepartidor extends Component
{
    public int $width;
    public int $height;

    /**
     * Create a new component instance.
     */
    public function __construct(int $width = 256, int $height = 256)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.icono-repartidor');
    }
}
