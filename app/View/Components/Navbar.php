<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    //per cambiare colore alla navbar in base alla pagina
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color)
    {
        //per cambiare colore alla navbar in base alla pagina
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
