<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Intervention;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentDate = Carbon::now();
        $intervnontraiter = Intervention::where('status_id', 1)->whereMonth('date_intervention', $currentDate->month)
            ->whereYear('date_intervention', $currentDate->year)->count();
        $intervcloturer = Intervention::where('status_id', 2)->whereMonth('date_intervention', $currentDate->month)
            ->whereYear('date_intervention', $currentDate->year)->count();
        $intervannuler = Intervention::where('status_id', 3)->whereMonth('date_intervention', $currentDate->month)
            ->whereYear('date_intervention', $currentDate->year)->count();
        $count = Contrat::whereDate('date_fin', '>', $currentDate)->count();
        $intervs = Intervention::whereMonth('date_intervention', $currentDate->month)
            ->whereYear('date_intervention', $currentDate->year)->with('user','interventionable')->orderBy('date_intervention')->get();

        $query = 'SELECT u.status, COUNT(s.status_id) as nbr
            FROM interventions s
            JOIN statuses u ON s.status_id = u.id
            GROUP BY u.status';

        $types = DB::select($query);

        $type = array();
        $nbrt = array();
        foreach ($types as $key) {
            array_push($type, $key->status);
            array_push($nbrt, $key->nbr);
        }

        $query2 = '
        select distinct us.name,COUNT(s.user_id) as nbr from  interventions s join statuses u on s.status_id = u.id
        JOIN users us ON us.id = s.user_id
        group by us.name ';
        $users = DB::select($query2);
        $names = array();
        $nbrs = array();
        foreach ($users as $key) {
            array_push($names, $key->name);
            array_push($nbrs, $key->nbr);
        }


        // dd($type);

        return view('home', compact('intervnontraiter', 'count', 'intervcloturer', 'intervannuler', 'intervs', 'currentDate', 'nbrt', 'type', 'names', 'nbrs'));
    }
}
