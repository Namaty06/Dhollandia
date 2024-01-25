@extends('dashboard.app')
@section('content')
    <!-- File Upload -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3>Document :</h3>
                <form action="{{ route('Document.store', $interv->id) }}" id="myForm" method="post" class=" mt-2 "
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="mb-3 col-md-4">
                            <label for="type" class="form-label">Type de Document :</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Selectionner Type de Document</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <input name="files[]" class="@error('files') is-invalid @enderror" onchange="onUpload(this.files)"
                            type="file" accept="image/*,.pdf" multiple />
                        <input type="hidden" name="pdfs" id="pdf" value="">
                        <div class="col-6 mt-2">
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div style="color: red;margin-top:3px;">:message</div>')) !!}
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" id="btn" class="btn btn-info mt-3">Upload</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>

    </div>
    <!-- Preview -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
    <script>
        var table = [];

        function onUpload(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const data = atob(e.target.result.replace(/.*base64,/, ''));
                        renderPDF(data);
                    }
                    reader.readAsDataURL(file);
                }
            }
        }

        async function renderPDF(data) {
            const pdf = await pdfjsLib.getDocument({
                data
            }).promise;
            for (let i = 1; i <= pdf.numPages; i++) {
                const image = document.createElement('img');
                const page = await pdf.getPage(i);
                const viewport = page.getViewport({
                    scale: 2
                });
                const canvas = document.createElement('canvas');
                const canvasContext = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                await page.render({
                    canvasContext,
                    viewport
                }).promise;
                const dataUrl = canvas.toDataURL('image/png');
                image.src = dataUrl;
                image.classList.add('img');
                table.push(dataUrl);
            }
            const btn = document.getElementById('btn');
            btn.addEventListener('click', e => {
                e.preventDefault();
                const input = document.getElementById('pdf');
                input.value = JSON.stringify(table);
                document.getElementById('myForm').submit();
            });
        }
    </script>
@endsection
