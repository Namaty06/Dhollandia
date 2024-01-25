@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h2>Contrats</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Ref</th>
                                        <th>Sociéte</th>
                                        <th>Vehicule</th>
                                        <th>Date Debut</th>
                                        <th>Date Expiration</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contrats as $contrat)
                                        <tr>

                                            <td>{{ $contrat->ref ?? null }}</td>
                                            <td>{{ $contrat->societe->societe ?? null }}</td>
                                            <td>{{ $contrat->vehicule->matricule ?? null }}</td>
                                            <td>{{ $contrat->date_debut ?? null }}</td>
                                            <td>{{ $contrat->date_fin ?? null }}</td>
                                            <td> <span
                                                    class="badge bg-{{ $contrat->status->color }}">{{ $contrat->status->status ?? null }}</span>
                                            </td>

                                            @can('viewAny', App\Models\Contrat::class)
                                            <td> <a class="btn btn-sm btn-info rounded-pill"
                                                    href="{{ route('Contrat.show', [$contrat->id]) }}">
                                                    <i class="uil uil-eye fs-5"></i>
                                                </a>
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
