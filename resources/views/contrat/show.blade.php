@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <h3 class="text-dark mx-1 my-1">Contrat</h3>
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

                                        <td>{{ $contrat->ref ?? null }}</td>
                                        <td>{{ $contrat->societe->societe ?? null }}</td>
                                        <td>{{ $contrat->vehicule->matricule ?? null }}</td>
                                        <td>{{ $contrat->user->name ?? null }}</td>
                                        <td>
                                            <span class="badge bg-{{ $contrat->status->color ?? null }}">
                                                {{ $contrat->status->status ?? null }}
                                            </span>
                                        </td>
                                        <td>{{ $contrat->created_at->format('Y-m-d H:i:s') ?? null }}</td>
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

        <h3 class="text-dark mx-1 my-1">Vehicule Sous Contrat</h3>
        @include('contrat.modalvehicule')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-2">
                            <button style="float: right" type="button" class=" mt-3 btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#full-width-modal">Assigner Vehicule</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Numero Serie Hayon</th>
                                        <th>Numero Serie Vehicule</th>
                                        <th>Ville</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contrat->vehicules as $vehicule)
                                        <tr>
                                            <td>{{ $vehicule->matricule ?? null }}</td>
                                            <td>{{ $vehicule->hayon->serie ?? null }}</td>
                                            <td>{{ $vehicule->numero_serie ?? null }}</td>
                                            <td>{{ $vehicule->ville->ville ?? null }}</td>
                                            <td>
                                                <form action="{{ route('Vehicule.detach', [$vehicule->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="contrat_id" value="{{ $contrat->id }}">

                                                    <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                        <i class="uil uil-trash fs-5"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach

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
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Date Intervention</th>
                                        <th>Technicien</th>
                                        <th>Hayon</th>
                                        <th>Date validation</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contrat->interventions as $intervention)
                                        <tr>
                                            <td>{{ $intervention->date_intervention ?? null }}</td>
                                            <td>{{ $intervention->user->name ?? null }}</td>
                                            <td>{{ $intervention->hayon->serie ?? null }}</td>
                                            <td>{{ $intervention->date_validation ?? null }}</td>
                                            <td> <span class="badge bg-{{ $intervention->status->color ?? null }}">
                                                    {{ $intervention->status->status ?? null }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="rounded-pill text-primary"
                                                    href="{{ route('interv.show', $intervention->id) }}">
                                                    <i class="uil uil-eye fs-4"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
