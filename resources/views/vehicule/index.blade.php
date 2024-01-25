@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <h2 class="text-dark"> Vehicules </h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped " class="display nowrap " id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Ville</th>
                                        <th>Sociéte</th>
                                        <th>Type</th>
                                        <th>Afficher</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    @forelse ($vehicules as $vehicule)
                                        <tr>

                                            <td>{{ $vehicule->matricule ?? null }}</td>
                                            <td>{{ $vehicule->ville->ville ?? null}}</td>
                                            <td>{{ $vehicule->societe->societe ?? null}}</td>
                                            <td>{{ $vehicule->typevehicule->type ?? null }}</td>



                                            @can('viewAny', App\Models\Vehicule::class)
                                                <td> <a class="btn btn-sm btn-info rounded-pill"
                                                        href="{{ route('Vehicule.show', [$vehicule->id]) }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan

                                            @can('update', App\Models\Vehicule::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Vehicule.edit', [$vehicule->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Vehicule::class)
                                                <td>

                                                    <form action="{{ route('Vehicule.destroy', [$vehicule->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            <i class="uil uil-trash fs-5"></i>
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
