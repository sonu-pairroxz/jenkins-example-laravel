<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FooterCategory extends Component
{
    public $footerCategory;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($footerCategory)
    {
        $this->footerCategory = $footerCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer-category');
    }
}
