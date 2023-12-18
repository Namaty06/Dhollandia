<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('Question.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="examen">Examen *:</label>
                        <select class="form-select @error('examen') is-invalid @enderror" name="examen"
                            id="examen">
                            @foreach ($examens as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->examen }}</option>
                            @endforeach
                        </select>
                        @error('examen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group mb-1">
                        <label for="question">Question *:</label>
                        <input type="text" name="question" value="{{ old('question') }}" required
                            class="form-control @error('question') is-invalid @enderror">
                        @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </div>
        </form>
    </div>
</div>
