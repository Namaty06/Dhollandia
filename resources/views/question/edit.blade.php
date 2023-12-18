@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Question.update',$question->id) }}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf


                        <div class="form-group mb-1">
                            <label for="question">Examen *:</label>
                            <input type="text" value="{{ $question->examen->examen ?? null }}" disabled
                                class="form-control @error('question') is-invalid @enderror">

                        </div>

                        <div class="form-group mb-1">
                            <label for="question">Question *:</label>
                            <input type="text" name="question" value="{{ $question->question ?? null }}" required
                                class="form-control @error('question') is-invalid @enderror">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @endsection
