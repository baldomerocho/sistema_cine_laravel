<?php

namespace App\View\Components\Admin;

use App\Models\Cine\Application\Country;
use Illuminate\View\Component;

class CreateMovie extends Component
{

    public $country_selected;



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $countries = Country::all();
        $county_selected = $this->country_selected;
        return view('components.admin.create-movie', compact('countries', 'county_selected'));
    }
}
