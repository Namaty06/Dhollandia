@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <h3> Detail Hayon</h3>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Num Serie</th>
                                        <th>Vehicule</th>
                                        <th>Capacité</th>
                                        <th>Type Hayon</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>

                                            <td>{{ $hayon->serie ?? null }}</td>
                                            <td>{{ $hayon->vehicule->matricule ?? null }}</td>
                                            <td>{{ $hayon->capacite ?? null }}</td>

                                            <td>{{ $hayon->typehayon->type ?? null }}</td>

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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>Modéle :</h4>
                <div class="card">
                    <div class="card-body">
                        <iframe width="600" height="800" src="{{ asset('storage/'.$hayon->pdf ) }}" frameborder="0"></iframe>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <h4>Historique Assignation :</h4>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" >
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Matricule</th>
                                        <th>Date Assignation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hayon->vehicules as $vehicule)
                                        <tr>
                                            <td>{{ $vehicule->societe->societe ?? null}}</td>
                                            <td>{{ $vehicule->matricule ?? null}}</td>
                                            <td>{{$vehicule->pivot->created_at ?? null }}</td>
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
