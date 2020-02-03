<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandAdd;
use App\Http\Requests\BrandEdit;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * @var
     */
    protected $brand;

    /**
     * BrandController constructor.
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * List brands
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['brands'] = $this->brand->withTrashed()->get(['id', 'name', 'logo', 'deleted_at']);
        return view('admin.brand.list', $data);
    }

    /**
     * View create new brands
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createBrand()
    {
        return view('admin.brand.add');
    }

    /**
     * Function create new brands
     *
     * @param BrandAdd $request
     * @return mixed
     */
    public function storeBrand(BrandAdd $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $this->brand->fill($request->only('name', 'slug', 'logo', 'description'));
                $this->brand->slug = str_slug($request->name);
                if ($request->hasFile('logo')) {
                    $fileName = md5(time() . $request->logo->getClientOriginalName()) . '.' . $request->logo->getClientOriginalExtension();
                    $request->logo->storeAs('brands', $fileName);
                    $this->brand->logo = $fileName;
                }
                $this->brand->save();
                return redirect()->route('admin.brands')->with("success", trans('flash-message.add-brand-success'));
            } catch (\Exception $e) {
                return back()->with('error', trans('flash-message.edit-brand-error'));
            }
        });
    }

    /**
     * View edit brands
     *
     * @param Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editBrand(Brand $brand)
    {
        return view('admin.brand.edit', $brand);
    }

    /**
     * Function update brands
     *
     * @param BrandEdit $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBrand(BrandEdit $request, Brand $brand)
    {
        $cur_logo = $brand->logo;
        $brand->fill($request->only('name', 'slug', 'logo', 'description'));
        if ($request->hasFile('logo')) {
            if ($cur_logo != null) {
                unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'brands' . DIRECTORY_SEPARATOR . $cur_logo);
            }
            $fileName = md5($request->logo->getClientOriginalName()) . '.' . $request->logo->getClientOriginalExtension();
            $brand->logo = $fileName;
            $request->logo->storeAs('brands', $fileName);
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('success', trans('flash-message.edit-brand-success'));
    }

    /**
     * Function delete brands
     *
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
        return response()->json($brand, 200);
    }

    /**
     * Function restore brands
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreBrand($id)
    {
        $brand = $this->brand->onlyTrashed()->find($id);
        $brand->restore();
        return response()->json($brand, 200);
    }
}
