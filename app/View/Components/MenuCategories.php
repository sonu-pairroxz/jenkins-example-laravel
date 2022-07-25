<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuCategories extends Component
{
    public $menuCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menuCategories)
    {
        $this->menuCategories = $menuCategories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-categories');
    }
}
