@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <h2 class="text-dark"> Sociéte </h2>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>

                                        <th>Logo</th>
                                        <th>Sociéte</th>
                                        <th>Responsable</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Tel</th>
                                        <th>Fix</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($societes as $societe)
                                        <tr>
                                            <td><img src="{{ asset('storage/'.$societe->logo) }}" style="width: 50%" class="img-fluid"
                                                    alt=""></td>
                                            <td>{{ $societe->societe ?? null }}</td>
                                            <td>{{ $societe->responsable ?? null }}</td>
                                            <td>{{ $societe->email ?? null }}</td>
                                            <td>{{ $societe->adresse ?? null }}</td>
                                            <td>{{ $societe->telephone ?? null }}</td>
                                            <td>{{ $societe->fix ?? null }}</td>
                                            {{-- @can('viewAny', App\Models\Vehicule::class)
                                                <td> <a class="btn btn-sm btn-info rounded-pill"
                                                        href="{{ route('Vehicule.show', [$vehicule->id]) }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan --}}

                                            @can('update', App\Models\Societe::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Societe.edit', [$societe->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Societe::class)
                                                <td>
                                                    <form action="{{ route('Societe.destroy', [$societe->id]) }}"
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
