@extends('dashboard.app')
@section('content')
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
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($questions as $question)
                                <tr>

                                    <td>{{ $question->id ?? null }}</td>

                                    <td>{{ $question->question ?? null }}</td>





                                    @can('restore', App\Models\Question::class)
                                        <td>

                                            <form action="{{ route('Question.restore', [$question->id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-warning rounded-pill" type="submit">
                                                    Restaurer
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
@endsection
