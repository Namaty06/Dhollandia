@extends('dashboard.app')
@section('content')
    <div class="row">
       <div class="page-title-box">
            <div class="page-title-left ">
                <h2 class="text-dark my-2 mx-2">Intervention</h2>
            </div>
            <div class="page-title-right ">
                <a href="{{ route('Document.create', $interventionsContract->id) }}" class="mt-2 btn btn-outline-dark">Ajouter Document</a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" class="display nowrap" id="">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Contrat</th>
                                    <th>Vehicule</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $interventionsContract->interventionable->societe->societe ?? null }}</td>
                                    <td>{{ $interventionsContract->interventionable->ref ?? null }}</td>
                                    <td>{{ $interventionsContract->interventionable->vehicule->matricule ?? null }}</td>
                                    <td>{{ $interventionsContract->date_intervention ?? null }}</td>
                                    <td>{{ $interventionsContract->user->name ?? null }}</td>
                                    <td> <span class="badge bg-{{ $interventionsContract->status->color }}">
                                            {{ $interventionsContract->status->status ?? null }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if ($interventionsContract->status_id == 2)
        <div class="row">

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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <iframe width="600px" height="800px"
                            src="{{ asset('storage/documents/' . $interventionsContract->rapport->path) }}" frameborder="0"></iframe>
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

        const locations = <?php print json_encode($interventionsContract); ?>;
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
