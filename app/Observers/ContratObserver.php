<?php

namespace App\Observers;

use App\Models\Contrat;
use App\Models\Intervention;
use App\Models\Vehicule;
use Carbon\Carbon;

class ContratObserver
{
    /**
     * Handle the Contrat "created" event.
     */
    public function created(Contrat $contrat): void
    {
        $toDate = Carbon::parse($contrat->date_fin);
        $fromDate = Carbon::parse($contrat->date_debut);
        $months = $toDate->diffInMonths($fromDate);
        $j = $contrat->intervention_chaque;
        for ($i = $j; $i < $months; $i = $i + $j) {
            $date = $contrat->created_at;
            $dm = $date->addMonths($i);
            $new = Carbon::parse($dm)->startOfMonth()->format('Y-m-d');
            $contrat->interventions()->create([
                'date_intervention' => $new,
                'contrat_id' => $contrat->id,
                'status_id' => 1
            ]);
        }
        $vehicule = Vehicule::whereId($contrat->vehicule_id)->firstOrFail();
    }

    /**
     * Handle the Contrat "updated" event.
     */
    public function updated(Contrat $contrat): void
    {
       if($contrat->status_id != 1){
        $interventions= Intervention::where('contrat_id',$contrat->id)->where('status_id',1)->get();
        foreach($interventions as $interv){
            $interv->status_id = 3;
            $interv->update();
        }
        $vehicule = Vehicule::whereId($contrat->vehicule_id)->firstOrFail();
        $vehicule->status= 0;
        $vehicule->update();
       }
    }

    /**
     * Handle the Contrat "deleted" event.
     */
    public function deleted(Contrat $contrat): void
    {
        $interventions= Intervention::where('contrat_id',$contrat->id)->get();
        foreach($interventions as $interv){
            $interv->delete();
        }
        $vehicule = Vehicule::whereId($contrat->vehicule_id)->firstOrFail();
        $vehicule->status= 0;
        $vehicule->update();
    }

    /**
     * Handle the Contrat "restored" event.
     */
    public function restored(Contrat $contrat): void
    {
        $interventions= Intervention::withTrashed()->where('contrat_id',$contrat->id)->get();
        foreach($interventions as $interv){
            $interv->restore();
        }

    }

    /**
     * Handle the Contrat "force deleted" event.
     */
    public function forceDeleted(Contrat $contrat): void
    {
        //
    }
}
