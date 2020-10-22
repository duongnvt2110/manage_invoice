<?php

namespace App\Http\Controllers;

use App\LoanApplication;
use App\User;
use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loanApps = LoanApplication::with('status','userAnalyst','userCfo')->get();
        $user = auth()->user();
        return view('loan.index',compact('loanApps','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('loan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $loanForm = $request->only('amount','description');
        $loanForm['status_id'] = 1;
        LoanApplication::create($loanForm);
        return redirect()->route('loan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication,Request $request)
    {
        //
        $loanApplication = $loanApplication->find($request->input('id'));
        $user = auth()->user();
        return view('loan.show',compact('loanApplication','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LoanApplication $loanApplication)
    {
        //
        $loanApplication = $loanApplication->find($request->input('id'));
        return view('loan.edit',compact('loanApplication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApplication $loanApplication)
    {
        //
        $loan = $loanApplication->find($request->input('id'));
        $status = $request->input('status');

        if(isset($status)){
            $loan->update([
                'status_id'=> $status
            ]);
        }else{
            if($loan->status_id == 1){
                $column = 'analyst_id';
                $user_id = $request->input('user_id');
                $status_id = 2;
            }else if(in_array($loan->status_id,[3,4])){
                $column = 'cfo_id';
                $user_id = $request->input('user_id');
                $status_id = 5;
            }
            $loan->update([
                $column => $user_id,
                'status_id'=> $status_id
            ]);
        }
        return redirect()->route('loan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        //
    }

    public function analyze(Request $request,LoanApplication $loanApplication){
        $loanApplication = $loanApplication->find($request->input('id'));
        $users = User::whereHas('roles',function($query) use ($loanApplication){
            if($loanApplication->status_id == 1){
                $query->where('name','=','analyst');
            }else{
                $query->where('name','=','cfo');
            }
        })->get();
        return view('loan.analyze',compact('users','loanApplication'));
    }

    public function updateAnalyze(Request $request,LoanApplication $loanApplication){
        $loan = $loanApplication->find($request->input('id'));
        $checkStatus = $request->input('status');
        if(empty($checkStatus)){
            if($loan->status_id == 2){
                $status_id = ($checkStatus == 0)?3:4;
            }else if($loan->status_id == 5){
                $status_id = ($checkStatus == 0)?6:7;
            }
            $loan->update([
                'status_id'=> $status_id
            ]);
        }
        return redirect()->route('loan.index');
    }
}
