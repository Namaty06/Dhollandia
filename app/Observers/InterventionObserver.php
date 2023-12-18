<?php

namespace App\Observers;

use App\Mail\SendRapport;
use App\Models\Intervention;
use App\Models\Rapport;
use Illuminate\Support\Facades\Mail;

class InterventionObserver
{
    /**
     * Handle the Intervention "created" event.
     */
    public function created(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "updated" event.
     */
    public function updated(Intervention $intervention): void
    {
        // $rapport = Rapport::where('intervention_id',$intervention->id)->with('intervention.contrat.societe')->firstOrFail();
        // Mail::to($rapport->intervention->contrat->societe->email)->send(new SendRapport($rapport));
    }

    /**
     * Handle the Intervention "deleted" event.
     */
    public function deleted(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "restored" event.
     */
    public function restored(Intervention $intervention): void
    {
        //
    }

    /**
     * Handle the Intervention "force deleted" event.
     */
    public function forceDeleted(Intervention $intervention): void
    {
        //
    }
}
