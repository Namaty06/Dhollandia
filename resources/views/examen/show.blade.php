@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-6">
                                        <a href="{{ route('Question.create') }}" class="btn btn-primary">Créer Question</a>
                                    </div>
                                    <div class="col-6">
                                        <a style="float: right" href="{{ route('Question.deleted') }}" class="btn btn-warning">Restaurer Question</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Icon</th>
                                        <th>Examen</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{ $examen->id ?? null }}</td>
                                        <td><img style="max-width: 40px" src="{{ asset('storage/' . $examen->icon) }}"
                                                class="img-fluid" alt=""></td>
                                        <td>{{ $examen->examen ?? null }}</td>




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

                                </tbody>
                            </table>
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
                                        <th>Question</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examen->question as $question)
                                        <tr>

                                            <td>{{ $question->id ?? null }}</td>

                                            <td>{{ $question->question ?? null }}</td>




                                            @can('update', App\Models\Question::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Question.edit', [$question->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Question::class)
                                                <td>

                                                    <form action="{{ route('Question.destroy', [$question->id]) }}"
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
