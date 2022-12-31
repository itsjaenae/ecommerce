<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Service,
    Repositories\Backend\ServiceRepository,
    Http\Requests\ImageStoreRequest,
    Http\Requests\ImageUpdateRequest,
    Http\Controllers\Controller
};
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\ServiceRepository $repository
     *
     */
    public function __construct(ServiceRepository $repository)
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
        return view('backend.service.index',[
            'datas' => Service::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'details' => 'nullable',
            'photo' => 'required|image',
        ]);
        $this->repository->store($request);
        return redirect()->route('admin.service.index')->withSuccess(__('New Service Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('backend.service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|max:100',
            'details' => 'nullable',
            'photo' => 'image',
        ]);
        $this->repository->update($service, $request);
        return redirect()->route('admin.service.index')->withSuccess(__('Service Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->repository->delete($service);
        return redirect()->route('admin.service.index')->withSuccess(__('Service Deleted Successfully.'));
    }
}
