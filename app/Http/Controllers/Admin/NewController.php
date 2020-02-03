<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewAdd;
use App\Http\Requests\NewEdit;
use App\Models\NewDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    protected $new;

    public function __construct(NewDetail $new)
    {
        $this->new = $new;
    }

    /**
     * List news
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['listNews'] = $this->new
            ->orderBy('created_at', 'DESC')
            ->withTrashed()
            ->get(['id', 'name','image', 'created_at', 'deleted_at']);
        return view('admin.new.list', $data);
    }

    /**
     * View create news
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createNew()
    {
        return view('admin.news.add');
    }

    /**
     * @param NewAdd $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNew(NewAdd $request)
    {
        $this->new->fill($request->all());
        if ($request->hasFile('image')) {
            $fileName = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('news', $fileName);
            $this->new->image = $fileName;
        }
        $this->new->slug = str_slug($request->name);
        $this->new->save();
        return redirect()->route('admin.news')->with('success', trans('flash-message.add-new-success'));
    }

    public function editNew(NewDetail $new)
    {
        return view('admin.news.edit', $new);
    }

    public function updateNew(NewEdit $request, NewDetail $new)
    {
        $cur_img = $new->image;
        $new->fill($request->all());
        if ($request->hasFile('image')) {
            unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $cur_img);
            $fileName = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
            $arr['image'] = $fileName;
            $request->image->storeAs('news', $fileName);
        }
        $new->slug = str_slug($request->name);
        $new->save();
        return redirect()->route('admin.news')->with('success', trans('flash-message.edit-new-success'));
    }

    public function deleteNew(NewDetail $new)
    {
        $new->delete();
        return response()->json($new, 200);
    }

    public function restoreNew($id)
    {
        $this->new->onlyTrashed()->where('id', $id)->restore();
        return response()->json($id);
    }
}
