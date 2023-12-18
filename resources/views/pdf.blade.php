<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            padding: 7px
        }
    </style>
</head>

<body style="container">
    <div>
        <img src="img/logo.jpg" style="height:auto; width:200px; float: left !important">
        <div style="float: right !important;margin-right: 50px">
            <h2>{{ $inter->interventionable->societe->societe ?? null }}</h2>
            <p>{{ $inter->interventionable->societe->email ?? null }}</p>
        </div>
    </div>
    <hr style="color: rgb(253, 119, 9);margin-top:150px; border:2px solid">
    <div style="margin-top: 30px">
        <table style="width:100%;">
            <tr style="background-color: orange">
                <th>Rapport Ref:</th>
                <td>{{ $rapport->ref ?? null }}</td>
            </tr>
            <tr>
                <th>Date et heure d’inter :</th>
                <td>{{ $inter->date_validation }}</td>

            </tr>
            <tr>
                <th>Lieu d’inter (Coordonnées GPS) :</th>
                <td>latitude : {{ $inter->lat }}; longitude :{{ $inter->lng }}</td>
            </tr>
            <tr>
                <th>Nom du Technicien :</th>
                <td> {{ $inter->user->name }} </td>
            </tr>
            <tr>
                <th> Immatriculation :</th>
                <td> {{ $inter->interventionable->vehicule->matricule ?? null }} </td>
            </tr>
            <tr>
                <th>Numéro de série du hayon:</th>
                <td> {{ $inter->interventionable->vehicule->numero_serie ?? null }}</td>
            </tr>
            <tr>
                <th>Type du hayon :</th>
                <td> {{ $inter->interventionable->vehicule->typevehicule->type ?? null }} </td>
            </tr>
            <tr>
                <th>Capacité du hayon :</th>
                <td> {{ $inter->interventionable->vehicule->capacite ?? null }} KG </td>
            </tr>
            <tr>
                <th>Marque du hayon:</th>
                <td> {{ $inter->interventionable->vehicule->marque ?? null }}</td>
            </tr>

        </table>

    </div>

    <div style="">
        <table style="width:100%;">
            <tr>
                <th style="width: 100%">Rapport Ref:</th>

            </tr>
            @foreach ($inter->question as $question)
                @if ($question->pivot->answer)
                    <tr>
                        <th style="width: 70%">{{ $question->question ?? null }}</th>
                        <td style="width: 30%">{{ $question->pivot->answer }}</td>
                    </tr>
                @endif
            @endforeach


        </table>

    </div>
    <hr style="color: rgb(253, 119, 9);margin-top:150px; border:2px solid">
    @foreach ($inter->question as $question)
        @if ($question->pivot->answer == false)
            <div style="margin-top: 20px">
                <p style="margin-bottom: ">{{ $question->question }}</p>
                <img style="width: 700px;height:auto;" src="{{ asset('storage/images/'.$question->path) }}" alt="">
            </div>
        @endif
    @endforeach


</body>

</html>
