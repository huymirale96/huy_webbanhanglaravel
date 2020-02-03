<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\BannerAdd;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    protected $banner;

    /**
     * BannerController constructor.
     * @param Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Get all banners
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['banners'] = $this->banner
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->get(['id', 'name', 'image', 'deleted_at']);
        return view('admin.banner.list', $data);
    }

    /**
     * Get view create banner
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createBanner()
    {
        return view('admin.banner.add');
    }

    /**
     * Add new banner
     *
     * @param BannerAdd $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeBanner(BannerAdd $request)
    {
        $this->banner->fill($request->only('name', 'image', 'content', 'slug'));
        $this->banner->slug = str_slug($request->name);
        $fileName = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('banners', $fileName);
        $this->banner->image = $fileName;
        $this->banner->save();
        return redirect()->route('admin.banners')->with(['success', trans('flash-message.add-banner-success')]);
    }

    /**
     * Get view edit
     *
     * @param Banner $banner
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editBanner(Banner $banner)
    {
        return view('admin.banner.edit', $banner);
    }

    /**
     * Update banner
     *
     * @param BannerAdd $request
     * @param Banner $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBanner(BannerAdd $request, Banner $banner)
    {
        $cur_image = $banner->image;
        $banner->fill($request->only('name', 'slug', 'image', 'content'));
        $banner->slug = str_slug($request->name);
        unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'banners' . DIRECTORY_SEPARATOR . $cur_image);
        $fileName = md5($request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
        $banner->image = $fileName;
        $request->image->storeAs('banners', $fileName);
        $banner->save();
        return redirect()->route('admin.banners')->with('success', trans('flash-message.edit-banner-success'));
    }

    /**
     * Delete banner
     *
     * @param Banner $banner
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteBanner(Banner $banner)
    {
        $banner->delete();
        return response()->json($banner, 200);
    }

    /**
     * Restore banner
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreBanner($id)
    {
        $this->banner->onlyTrashed()->where('id', $id)->restore();
        return response()->json();
    }
}
