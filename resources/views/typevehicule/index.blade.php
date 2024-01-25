@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Type Vehicule</h3>
                        <div class="row">
                            <div class="d-flex">

                                <div class="col-3">
                                    @can('create', App\Models\Configuration::class)
                                    <a href="{{ route('TypeVehicule.create') }}" class="btn btn-primary">Créer</a>
                                    @endcan

                                </div>
                                <div class="col-6">
                                    <h3 style=" text-align: center">Type Vehicule</h3>
                                </div>
                                <div class="col-3">
                                    @can('restore', App\Models\Configuration::class)
                                    <a style="float: right" href="{{ route('TypeVehicule.deleted') }}"
                                        class="btn btn-warning">Restaurer</a>
                                    @endcan
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
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($types as $type)
                                        <tr>

                                            <td>{{ $type->id ?? null }}</td>
                                            <td>{{ $type->type ?? null }}</td>

                                            @can('update', App\Models\Configuration::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('TypeVehicule.edit', [$type->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Configuration::class)
                                                <td>
                                                    @if ($type->id != 1)
                                                        <form action="{{ route('TypeVehicule.destroy', [$type->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                                <i class="uil uil-trash fs-5"></i>
                                                            </button>
                                                        </form>
                                                    @endif
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
