@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <h3 class="text-dark mx-1 my-1">Reclamation</h3>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="">
                                <thead>
                                    <tr>
                                        <th>Réference</th>
                                        <th>Sociéte</th>
                                        <th>Vehicule</th>
                                        <th>Technicien</th>
                                        <th>Status</th>
                                        <th>Date Creation</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{ $reclamation->ref ?? null }}</td>
                                        <td>{{ $reclamation->societe->societe ?? null }}</td>
                                        <td>{{ $reclamation->vehicule->matricule ?? null }}</td>
                                        <td>{{ $reclamation->user->name ?? null }}</td>
                                        <td>
                                            <span class="badge bg-{{ $reclamation->status->color ?? null }}">
                                                {{ $reclamation->status->status ?? null }}
                                            </span>
                                        </td>
                                        <td>{{ $reclamation->created_at->format('Y-m-d H:i:s') ?? null }}</td>
                                        {{-- @can('viewAny', App\Models\Vehicule::class)
                                                <td> <a class="btn btn-sm btn-info rounded-pill"
                                                        href="{{ route('Vehicule.show', [$vehicule->id]) }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan --}}

                                        {{-- @can('update', App\Models\Societe::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Societe.edit', [$societe->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan --}}


                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <h3 class="text-dark mx-1 my-1">Intervention</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="">
                                <thead>
                                    <tr>
                                        <th>Date Intervention</th>
                                        <th>Technicien</th>
                                        <th>Date validation</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $reclamation->interventions->date_intervention ?? null }}</td>
                                        <td>{{ $reclamation->interventions->user->name ?? null }}</td>
                                        <td>{{ $reclamation->interventions->date_validation ?? null }}</td>
                                        <td> <span
                                                class="badge bg-{{ $reclamation->interventions->status->color ?? null }}">
                                                {{ $reclamation->interventions->status->status ?? null }}
                                            </span>
                                        </td>
                                        <td>
                                            <a class="rounded-pill text-primary"
                                            href="{{ route('interv.show', $reclamation->interventions->id) }}">
                                            <i class="uil uil-eye fs-4"></i>
                                        </a>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
