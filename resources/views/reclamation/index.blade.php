@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <h2 class="text-dark my-2 mx-2">Reclamation</h2>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Réference</th>
                                        <th>Sociéte</th>
                                        <th>Vehicule</th>
                                        <th>Technicien</th>
                                        <th>Status</th>
                                        <th>Date Creation</th>
                                        <th>Detail</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reclamations as $reclamation)
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
                                            @can('viewAny', App\Models\Reclamation::class)
                                                <td> <a class="btn btn-sm btn-info rounded-pill"
                                                        href="{{ route('Reclamation.show', [$reclamation->id]) }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan

                                            {{-- @can('update', App\Models\Societe::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Societe.edit', [$societe->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan --}}


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
