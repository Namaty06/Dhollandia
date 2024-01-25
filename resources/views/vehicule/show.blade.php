@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <h3 class="text-dark my-2 mx-2"> Vehicule</h3>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>N Serie</th>
                                        <th>Matricule</th>
                                        <th>Societé</th>
                                        <th>Ville</th>
                                        <th>Capacité</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img style="width: 300px" src="{{ asset('storage/' . $vehicule->image) }}"
                                                class="img-fluid" alt="">
                                        </td>
                                        <td>{{ $vehicule->numero_serie ?? null }}</td>
                                        <td>{{ $vehicule->matricule ?? null }}</td>
                                        <td>{{ $vehicule->societe->societe ?? null }}</td>
                                        <td>{{ $vehicule->ville->ville ?? null }}</td>
                                        <td>{{ $vehicule->capacite ?? null }}</td>
                                        <td>{{ $vehicule->typevehicule->type ?? null }}</td>
                                        <td class="">
                                            <span class="badge bg-{{ $vehicule->status->color ?? null }}">
                                                {{ $vehicule->status->status ?? null }}
                                            </span>
                                        </td>

                                        @can('update', App\Models\Vehicule::class)
                                            <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                    href="{{ route('Vehicule.edit', [$vehicule->id]) }}">
                                                    <i class="uil uil-pen fs-5"></i>
                                                </a>
                                            </td>
                                        @endcan
                                        @can('delete', App\Models\Vehicule::class)
                                            <td>

                                                <form action="{{ route('Vehicule.destroy', [$vehicule->id]) }}" method="post">
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
            @if ($vehicule->pdf)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Fiche Vehicule :</h3>
                            <iframe style="width: 100%; height:950px" src="{{ asset('storage/' . $vehicule->pdf) }}"
                                frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="">
                        <ul class="nav nav-tabs nav-stacked border-dark ">
                            <li class="nav-item ">
                                <button type="button" data-filter="ALL" class="link nav-link" style=" cursor: pointer;"
                                    value="ALL">TOUT
                                </button>
                            </li>
                            @foreach ($typedocuments as $type)
                                <li class="nav-item ">
                                    <button type="button" data-filter="{{ $type->type }}" class="link nav-link"
                                        style=" cursor: pointer;" value="{{ $type->id }}">{{ $type->type }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-body m-1" id="galley" style="height: 400px; overflow-y:auto">
                            @if ($vehicule->document)
                                <ul style="list-style-type: none;" id="row" class="row">
                                    @foreach ($vehicule->document as $doc)
                                        <li data-category="{{ $doc->typedocument->type ?? null }}"
                                            class="box container col-3 media {{ $doc->typedocument->type ?? null }} ">
                                            <img src="{{ asset('storage/images/' . $doc->path) }}" alt="img"
                                                class="img-fluid m-1" srcset="">
                                            <div class="middle">

                                            </div>
                                            <span class="badge  bg-info m-1"
                                                style="display: block;">{{ $doc->typedocument->type ?? null }}</span>


                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
            @if ($vehicule->hayon)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Hayon</h3>
                            <div class="table-responsive">
                                <table class="table " class="display nowrap" id="">

                                <thead>
                                    <tr>
                                        <th>Num Serie</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $vehicule->hayon->serie ?? null }}</td>
                                        <td>{{ $vehicule->hayon->typehayon->type ?? null }}</td>
                                        @can('update', App\Models\Hayon::class)@endcan
                                        <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                href="{{ route('Hayon.edit', [$vehicule->hayon->id]) }}">
                                                <i class="uil uil-pen fs-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
@section('script')
    <script>
        var $mediaElements = $('.media');

        $('.link').click(function(e) {
            e.preventDefault();

            // get the category from the data attribute
            var filterVal = $(this).data('filter');
            console.log(filterVal);

            var type_id = this.value;

            if (filterVal === 'ALL') {
                $mediaElements.show();
            } else {
                // hide all then filter the ones to show
                $mediaElements.hide().filter('[data-category="' + filterVal + '"]').show();
            }
        });
    </script>
@endsection
