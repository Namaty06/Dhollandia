@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <h3 class="text-dark"> Vehicule :</h3>

                    <form action="{{ route('Vehicule.update', $vehicule->id) }}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-1">
                            <label for="typevehicule">Client *:</label>
                            <select class="form-select @error('societe') is-invalid @enderror" name="societe"
                                id="societe">
                                <option value="{{ $vehicule->societe->id }}">{{ $vehicule->societe->societe }}</option>
                                @foreach ($societes as $societe)
                                    @if ($societe->id != $vehicule->societe_id)
                                    <option value="{{ $societe->id }}">{{ $societe->societe }}</option>

                                    @endif
                                @endforeach
                            </select>
                            @error('societe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-1">
                            <label for="numero_serie">Numero Serie *:</label>
                            <input type="text" name="numero_serie" value="{{ $vehicule->numero_serie ?? null }}" required
                                class="form-control @error('numero_serie') is-invalid @enderror">
                            @error('numero_serie')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="matricule">Matricule *:</label>
                            <input type="matricule" name="matricule" value="{{ $vehicule->matricule ?? null }}" required
                                class="form-control @error('matricule') is-invalid @enderror">
                            @error('matricule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-1">
                            <label for="marque">Marque *:</label>
                            <input type="marque" name="marque" value="{{ $vehicule->marque ?? null }}" required
                                class="form-control @error('marque') is-invalid @enderror">
                            @error('marque')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="dmc">DMC *:</label>
                            <input type="date" name="dmc" value="{{ $vehicule->dmc }}" required
                                class="form-control @error('dmc') is-invalid @enderror">
                            @error('dmc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        {{-- <div class="form-group mb-1">
                            <label for="capacite">Capacite *:</label>
                            <input type="number" name="capacite" value="{{ $vehicule->capacite ?? null }}" required
                                class="form-control @error('capacite') is-invalid @enderror">
                            @error('capacite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-1">
                            <label for="typevehicule">Type *:</label>
                            <select class="form-select @error('typevehicule') is-invalid @enderror" name="typevehicule"
                                id="typevehicule">
                                <option value="{{ $vehicule->typevehicule->id ?? null }}">
                                    {{ $vehicule->typevehicule->type ?? null }}</option>
                                @foreach ($types as $typevehicule)
                                    @if ($typevehicule->id != $vehicule->typevehicule->id)
                                        <option value="{{ $typevehicule->id }}">{{ $typevehicule->type }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('typevehicule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="typevehicule">Ville *:</label>
                            <select class="form-select @error('ville') is-invalid @enderror" name="ville" id="ville">
                                <option value="{{ $vehicule->ville->id }}">{{ $vehicule->ville->ville }}</option>

                                @foreach ($villes as $ville)
                                    @if ($ville->id != $vehicule->ville_id)
                                        <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ville')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        {{-- <div class="form-group mb-1">
                            <label for="capacite">Image *:</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}



                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <h3 class="text-dark"> Document :</h3>
                    <form action="{{ route('Vehicule.upload', $vehicule->id) }}" id="myForm" method="post"
                        class=" mt-2 " enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-2">
                            <div class="mb-3 col-md-4">
                                <label for="type" class="form-label">Type de Document :</label>
                                <select name="type" id="type"
                                    class="form-control @error('type') is-invalid @enderror">
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

                            <input name="files[]" class="@error('files') is-invalid @enderror"
                                onchange="onUpload(this.files)" type="file" accept="image/*,.pdf" multiple />
                            <input type="hidden" name="pdfs" id="pdf" value="">
                            <div class="col-6 mt-2">
                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div style="color: red;margin-top:3px;">:message</div>')) !!}
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" id="btn" class="btn btn-info mt-3">Uploader</button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
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
