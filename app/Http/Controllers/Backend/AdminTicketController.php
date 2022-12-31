<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Ticket,
    Repositories\Backend\TicketRepository,
    Http\Controllers\Controller
};
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\TicketRepository $repository
     *
     */
    public function __construct(TicketRepository $repository)
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
    public function index(Request $request)
    {
        if($request->type){
            $datas = Ticket::whereStatus($request->type)->get();
        }else{
            $datas = Ticket::orderBy('id','desc')->get();
        }
        return view('backend.ticket.index',[
            'datas' => $datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ticket.create');
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
            'file' => 'file|mimes:zip|max:5000',
            'email' => 'required|exists:users,email',
            'message' => 'required|max:255',
            'subject' => 'required|max:255'
        ]);
        
        $this->repository->store($request);
        return redirect()->route('admin.ticket.index')->withSuccess(__('New Ticket Added Successfully.'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        Ticket::find($id)->update(['status' => 'Closed']);
        return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket Close Successfully.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('backend.ticket.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|max:255'
        ]);
        $this->repository->update($ticket, $request);
        return redirect()->back()->withSuccess(__('Ticket Reply Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->repository->delete($ticket);
        return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket Deleted Successfully.'));
    }
}
