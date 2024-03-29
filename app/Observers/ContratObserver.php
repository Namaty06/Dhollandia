<?php

namespace App\Observers;

use App\Models\Contrat;
use App\Models\Intervention;
use App\Models\TypePanne;
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
        // Calculate the total number of months
        $totalMonths = $toDate->diffInMonths($fromDate);
        // Calculate the number of months for each year
        $years = $toDate->diffInYears($fromDate);

        $monthsPerYear = ceil($totalMonths / $years);
        // Loop to create interventions for each year
        for ($year = 0; $year < $years; $year++) {
            // Calculate start and end dates for the current year
            $startOfYear = $fromDate->copy()->addYears($year);
            $endOfYear = $startOfYear->copy()->addMonths($monthsPerYear);

            // If it's the last iteration, adjust the end date to the actual end date
            if ($year === $years - 1) {
                $endOfYear = $toDate;
            }

            // Calculate the number of months for the current iteration
            $months = $startOfYear->diffInMonths($endOfYear);

            // Loop to create interventions for each month within the current year
            for ($i = 0; $i < $months; $i += $contrat->intervention_chaque) {

                // Calculate the date for intervention
                $date = Carbon::parse($contrat->date_debut);
                $dm = $date->addMonths($i);

                $new = Carbon::parse($dm)->startOfMonth()->format('Y-m-d');

                // if ($dm > $date) {

                    // Create intervention record
                    foreach($contrat->vehicules as $vehicule)
                    {}
                        $contrat->interventions()->create([
                            'date_intervention' => $new,
                            'status_id' => 1,
                            'type_panne_id' => 1,
                            'hayon_id'=>5
                        ]);


                }
            // }
        }
    }

    /**
     * Handle the Contrat "updated" event.
     */
    public function updated(Contrat $contrat): void
    {
        if ($contrat->status_id != 1) {
            $interventions = Intervention::where('contrat_id', $contrat->id)->where('status_id', 1)->get();
            foreach ($interventions as $interv) {
                $interv->status_id = 3;
                $interv->update();
            }
            $vehicule = Vehicule::whereId($contrat->vehicule_id)->firstOrFail();
            $vehicule->status = 0;
            $vehicule->update();
        }
    }

    /**
     * Handle the Contrat "deleted" event.
     */
    public function deleted(Contrat $contrat): void
    {
        $interventions = Intervention::where('contrat_id', $contrat->id)->get();
        foreach ($interventions as $interv) {
            $interv->delete();
        }
        $vehicule = Vehicule::whereId($contrat->vehicule_id)->firstOrFail();
        $vehicule->status = 0;
        $vehicule->update();
    }

    /**
     * Handle the Contrat "restored" event.
     */
    public function restored(Contrat $contrat): void
    {
        $interventions = Intervention::withTrashed()->where('contrat_id', $contrat->id)->get();
        foreach ($interventions as $interv) {
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
