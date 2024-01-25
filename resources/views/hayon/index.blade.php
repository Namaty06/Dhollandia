@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex">
                                <div class="col-3">
                                    <a href="{{ route('Hayon.create') }}" class="btn btn-primary">Créer</a>
                                </div>
                                <div class="col-6">
                                    <h2 class="text-dark" style=" text-align: center"> Hayon</h2>
                                </div>
                                <div class="col-3">
                                    <a style="float: right" href="{{ route('Hayon.deleted') }}" class="btn btn-warning">Restaurer</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Num Serie</th>
                                        <th>Capacité</th>
                                        <th>Vehicule</th>
                                        <th>Type Hayon</th>
                                        <th>Detail</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($hayons as $hayon)
                                        <tr>
                                            <td>{{ $hayon->serie ?? null }}</td>
                                            <td>{{ $hayon->capacite ?? null }} KG</td>
                                            <td>{{ $hayon->vehicule->matricule ?? null }}</td>
                                            <td>{{ $hayon->typehayon->type ?? null }}</td>

                                            @can('viewAny', App\Models\Hayon::class)@endcan
                                            <td> <a class="btn btn-sm btn-info rounded-pill"
                                                    href="{{ route('Hayon.show', [$hayon->id]) }}">
                                                    <i class="uil uil-eye fs-5"></i>
                                                </a>
                                            </td>

                                            @can('update', App\Models\Hayon::class)@endcan
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Hayon.edit', [$hayon->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>

                                            @can('delete', App\Models\Hayon::class)  @endcan
                                                <td>


                                                    <form action="{{ route('Hayon.destroy', [$hayon->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            <i class="uil uil-trash fs-5"></i>
                                                        </button>
                                                    </form>


                                                </td>


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
