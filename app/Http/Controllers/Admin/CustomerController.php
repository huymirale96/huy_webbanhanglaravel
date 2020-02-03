<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    protected $customer, $district, $province, $ward;

    public function __construct(Customer $customer, Province $province, District $district, Ward $ward)
    {
        $this->ward = $ward;
        $this->district = $district;
        $this->province = $province;
        $this->customer = $customer;
    }

    /**
     * List customer
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['listCustomers'] = $this->customer
            ->withTrashed()
            ->get(['id', 'name', 'email', 'phone', 'deleted_at']);
        return view('admin.customer.list', $data);
    }

    /**
     * Get customer's profile
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile($id)
    {
        $data['customer'] = $this->customer->withTrashed()->find($id);
        $data['ward'] = $this->ward->find($data['customer']->ward_id);
        $data['district'] = $this->district->find($data['ward']->district_id);
        $data['province'] = $this->province->find($data['district']->province_id);
        return response()->json($data, 200);
    }
}

