<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Category,
    Repositories\Backend\SubCategoryRepository,
    Http\Requests\SubCategoryRequest,
    Http\Controllers\Controller
};
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\SubCategoryRepository $repository
     *
     */
    public function __construct(SubCategoryRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.subcategory.index',[
            'datas' => Subcategory::with('category')->orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('admin.subcategory.index')->withSuccess(__('New Subcategory Added Successfully.'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id,$status)
    {
        Subcategory::find($id)->update(['status' => $status]);
        return redirect()->route('admin.subcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        
        return view('backend.subcategory.edit',compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, Subcategory $subcategory)
    {
        $this->repository->update($subcategory, $request);
        return redirect()->route('admin.subcategory.index')->withSuccess(__('Subcategory Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $this->repository->delete($subcategory);
        return redirect()->route('admin.subcategory.index')->withSuccess(__('Subcategory Deleted Successfully.'));
    }
}
