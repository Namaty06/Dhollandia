@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="page-title-box">
            <div class="page-title-left ">
                <h2 class="text-dark mt-2 mx-2">Intervention</h2>
            </div>
            <div class="page-title-right ">
                <a href="{{ route('Document.create', $intervention->id) }}" class="mb-2 btn btn-outline-primary">Ajouter
                    Document</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" class="display nowrap" id="">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Reclamation</th>
                                    <th>Vehicule</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $intervention->interventionable->societe->societe ?? null }}</td>
                                    <td>{{ $intervention->interventionable->ref ?? null }}</td>
                                    <td>{{ $intervention->interventionable->vehicule->matricule ?? null }}</td>
                                    <td>{{ $intervention->date_intervention ?? null }}</td>
                                    <td>{{ $intervention->user->name ?? null }}</td>
                                    <td> <span class="badge bg-{{ $intervention->status->color }}">
                                            {{ $intervention->status->status ?? null }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-dark">Sociéte</h3>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sociéte</th>
                                <th>Libelle</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img style="height: 150px; width:150px"
                                        src="{{ asset('storage/' . $intervention->interventionable->societe->logo) }}"
                                        class="img-thumbnail" alt="">
                                </td>
                                <td>{{ $intervention->interventionable->societe->societe }}</td>
                                <td>{{ $intervention->interventionable->societe->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-dark">Vehicule</h3>
                    <table class="table table-striped">
                        <thead>

                            <tr>
                                <th>Vehicule</th>
                                <th>Matricule</th>
                                <th>N serie</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img style="height: 150px; width:150px"
                                        src="{{ asset('storage/' . $intervention->interventionable->vehicule->image ?? null) }}"
                                        class="img-thumbnail" alt=""></td>
                                <td>{{ $intervention->interventionable->vehicule->matricule ?? null }}</td>
                                <td>{{ $intervention->interventionable->vehicule->numero_serie ?? null }}</td>
                                <td>{{ $intervention->interventionable->vehicule->typevehicule->type ?? null }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($intervention->status_id == 2)
        <div class="row">
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
                            @if ($intervention->document)
                                <ul style="list-style-type: none;" id="row" class="row">
                                    @foreach ($intervention->document as $doc)
                                        <li data-category="{{ $doc->typedocument->type ?? null }}"
                                            class="box container col-3 media {{ $doc->typedocument->type ?? null }} ">
                                            <img src="{{ asset('storage/images/' . $doc->path) }}" alt="img"
                                                class="img-fluid m-1" srcset="">
                                            <div class="middle">
                                                {{-- <a href="{{ route('Document.edit', $doc->id) }}"
                                                        class="text append icon dripicons-document-edit"></a> --}}
                                                {{-- @if (Auth::user()->role_id == 4)
                                                        @if ($doc->type_document_id != 4 && $doc->type_document_id != 8)
                                                            <form class="deleteForm"
                                                                action="{{ route('Document.destroy', $doc->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirmDelete"
                                                                    style="padding: 0;border: none;background: none;"
                                                                    type="button"><i
                                                                        class="text append icon dripicons-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    @endif --}}
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <h4 class="header-title mb-2 mt-3">Localisation :</h4>
                            <div id="map" class="gmaps" style="height: 60vh"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endif
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initMap"
        async defer></script>
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
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 30.168831728404875,
                    lng: -7.46378273987113,
                    zoom: 6
                },
                zoom: 6,
                scrollwheel: true,
            });

            setMarkers(map);

        }

        const locations = <?php print json_encode($intervention); ?>;
        const image1 =
            "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png";

        function setMarkers(map) {
            const location = locations;

            new google.maps.Marker({
                position: {
                    lat: parseFloat(location.lat),
                    lng: parseFloat(location.lng)
                },
                label: {
                    color: 'blue',
                    fontWeight: 'bold',
                    text: location.user.name,
                },
                icon: {
                    url: image1,
                    size: new google.maps.Size(36, 50),
                    scaledSize: new google.maps.Size(36, 50),
                    anchor: new google.maps.Point(0, 50),
                    labelOrigin: new google.maps.Point(9, 8)

                },
                map,
                title: location,
                zIndex: location.lng,
            });

            // console.log(locations[i]);
        }
    </script>
@endsection
