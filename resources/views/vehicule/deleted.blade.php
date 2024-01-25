@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Ville</th>
                                        <th>Sociéte</th>
                                        <th>Type</th>
                                        <th>Restaurer</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vehicules as $vehicule)
                                        <tr>

                                            <td>{{ $vehicule->matricule ?? null }}</td>
                                            <td>{{ $vehicule->ville->ville ?? null}}</td>
                                            <td>{{ $vehicule->societe->societe ?? null}}</td>
                                            <td>{{ $vehicule->typevehicule->type ?? null }}</td>
                                           

                                            @can('restore', App\Models\Vehicule::class)
                                                <td>
                                                    <form action="{{ route('Vehicule.restore', [$vehicule->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            Restaurer
                                                        </button>
                                                    </form>
                                                </td>
                                            @endcan

                                        </tr>
                                    @empty
                                        <h3>Tableau Vide</h3>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
