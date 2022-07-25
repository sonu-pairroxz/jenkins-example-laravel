<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeBanner extends Component
{
    public $homeBanners;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($homeBanners)
    {
        $this->homeBanners = $homeBanners;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home-banner');
    }
}
