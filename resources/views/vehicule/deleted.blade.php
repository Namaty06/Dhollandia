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
                                        <th>Image</th>
                                        <th>N Serie</th>
                                        <th>Matricule</th>
                                        <th>Marque</th>
                                        <th>DMC</th>
                                        <th>Capacité</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vehicules as $vehicule)
                                        <tr>
                                            <td><img src="{{ asset('storage/'.$vehicule->image) }}" class="img-fluid"
                                                    alt=""></td>
                                            <td>{{ $vehicule->numero_serie ?? null }}</td>
                                            <td>{{ $vehicule->matricule ?? null }}</td>
                                            <td>{{ $vehicule->marque ?? null }}</td>
                                            <td>{{ $vehicule->date_circulation ?? null }}</td>
                                            <td>{{ $vehicule->capacite ?? null }}</td>
                                            <td>{{ $vehicule->typevehicule->type ?? null }}</td>
                                            <td>
                                                @if ($vehicule->status)
                                                <span class="badge bg-success">Travaille</span>
                                                @else
                                                <span class="badge bg-primary">Disponible</span>
                                                @endif
                                            </td>

                                            @can('delete', App\Models\Vehicule::class)
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
