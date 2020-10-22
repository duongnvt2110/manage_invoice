<?php

namespace App\Observers;

use App\LoanApplication;
use Illuminate\Support\Facades\Log;

class LoanApplicationObserver
{
    /**
     * Handle the loan application "created" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */
    public function created(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Handle the loan application "updated" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */
    public function updated(LoanApplication $loanApplication)
    {
        //
        // if($loanApplication->status_id == 2){
        //     $loanApplication->update(['analyst_id'=>2]);
        // }
        // if($loanApplication->status_id == 5){
        //     $loanApplication->update(['cfo_id'=>3]);
        // }

    }

    /**
     * Handle the loan application "deleted" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */
    public function deleted(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Handle the loan application "restored" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */
    public function restored(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Handle the loan application "force deleted" event.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return void
     */
    public function forceDeleted(LoanApplication $loanApplication)
    {
        //
    }
}
