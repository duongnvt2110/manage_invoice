<?php

namespace App\Http\Controllers;

use App\LoanApplication;
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
        return view('loan.index',compact('loanApps'));
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
    public function show(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanApplication $loanApplication)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApplication $loanApplication,$id)
    {
        //
        $loanForm = $request->only('status');
        $loan = LoanApplication::find($id);
        if(!empty($loanForm['status']) && $loanForm['status'] != 2){
            $loan->update(['status_id'=> $loanForm['status']]);
        }else{
            if($loan->status_id == 2){
                $loan->update(['status_id'=> 2]);
            }
            if(in_array($loan->status_id,[3,4])){
                $loan->update(['status_id'=> 5]);
            }
            if(in_array($loan->status_id,[6,7])){
                $loan->update(['status_id'=> 8]);
            }
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

    public function sendAnalyst(Request $request,$id){
        LoanApplication::where('id',$id)->update(['status_id'=> 2]);
        return redirect()->route('loan.index');
    }
}
