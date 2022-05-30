<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Symfony\Component\Intl\Countries;

class CountrySelect extends Component
{
    public $countries;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->countries=Countries::getNames('ar');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.country-select');
    }
}
