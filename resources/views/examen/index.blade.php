@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Ajouter Question
                                    </button>
                                </div>
                                <div class="col-6">
                                    <a style="float: right" href="{{ route('Question.deleted') }}" class="btn btn-warning">Restaurer Question</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('question.create')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Icon</th>
                                        <th>Examen</th>
                                        <th>Afficher</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examens as $examen)
                                        <tr>

                                            <td>{{ $examen->id ?? null }}</td>
                                            <td><img style="max-width: 40px" src="{{ asset('storage/' . $examen->icon) }}"
                                                    class="img-fluid" alt=""></td>
                                            <td>{{ $examen->examen ?? null }}</td>




                                            @can('viewAny', App\Models\Examen::class)
                                                <td> <a class="btn btn-sm btn-info rounded-pill"
                                                        href="{{ route('Examen.show', [$examen->id]) }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('update', App\Models\Examen::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Examen.edit', [$examen->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Examen::class)
                                                <td>

                                                    <form action="{{ route('Examen.destroy', [$examen->id]) }}" method="post">
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
