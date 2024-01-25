<?php

namespace App\Console\Commands;

use App\Models\Contrat;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ContratCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contrat:fin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expiration Contrat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDay = Carbon::today();
        $contrats = Contrat::where('date_fin',$currentDay)->get();

        foreach($contrats as $contrat){
            $contrat->status_id = 2;
            $contrat->update();
            $vehicule = Vehicule::whereId($contrat->vehicule_id)->first();
            $vehicule->status_id=5;
            $vehicule->update();
        }

    }
}
