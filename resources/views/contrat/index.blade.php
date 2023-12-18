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
                                        <th>Ref</th>
                                        <th>Sociéte</th>
                                        <th>Vehicule</th>
                                        <th>Date Debut</th>
                                        <th>Date Expiration</th>
                                        <th>Status</th>
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
                                                    style="badge bg-{{ $contrat->status->color }}">{{ $contrat->status->status ?? null }}</span>
                                            </td>

                                            {{-- @can('delete', App\Models\Examen::class)
                                                <td>
                                                    <form action="{{ route('Examen.destroy', [$examen->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            <i class="uil uil-trash fs-5"></i>
                                                        </button>
                                                    </form>
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
