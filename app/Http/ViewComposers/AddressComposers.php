<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\View\View;

class AddressComposers extends Controller
{
    /**
     * AddressComposers constructor.
     * @param Province $province
     * @param District $district
     * @param Ward $ward
     */
    public function __construct(Province $province, District $district, Ward $ward)
    {
        $this->provinces = $province->all();
        $this->districts = $district->where('province_id', 1)->get(['id', 'name']);
        $this->wards = $ward->where('district_id', 1)->get(['id', 'name']);
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'wards' => $this->wards,
        ]);
    }
}
