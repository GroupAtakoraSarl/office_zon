<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Service Immobilier</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
<div id="map" style="height: 400px; width: 100%;"></div>
<div>
    <h3>Sauvegarder vos Terrains</h3>
    <form action="{{ isset($terrain) ? route('terrains.update', $terrain->id) : route('terrains.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($terrain) ? 'Form Edit terrain' : 'ATAKORA localisation' }}</h6>
        </div>
        <div class="form-group">
            <label for="lat">Latitudes :</label>
            <textarea class="form-control @error('lat') is-invalid @enderror" id="lat" name="lat" required>{{ isset($terrain) ? $terrain->lat : '' }}</textarea>
            @error('lat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="lng">Longitude :</label>
            <textarea class="form-control @error('lng') is-invalid @enderror" id="lng" name="lng" required>{{ isset($terrain) ? $terrain->lng : '' }}</textarea>
            @error('lng')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Propriétaire Terrain :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  value="{{ isset($terrain) ? $terrain->name : '' }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning mb-3">Enregistrer</button> <button type="button"  id="Géolocaliser" class="btn btn-primary mb-3">Géolocaliser</button>
    </form>

    <script>
        var map;
        var points = [];
        var polygons = [];


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 7.281255, lng: 1.039647 },
                zoom: 10
            });

            // Chargez les polygones depuis le stockage local et affichez-les sur la carte
            var storedPolygons = localStorage.getItem('polygons');
            if (storedPolygons) {
                polygons = JSON.parse(storedPolygons);
                polygons.forEach(function(polygonData) {
                    polygonData.polygon.setMap(map);

                    // Ajoutez un gestionnaire de clic pour le polygone
                    polygonData.polygon.addListener('click', function() {
                        afficherProprietaire(polygonData.id);
                    });
                });
            }

            // Créez un gestionnaire de clic pour ajouter des points au polygone
            map.addListener('click', function(event) {
                ajouterPoint(event.latLng);
            });
        }

        function ajouterPoint(latLng) {
            points.push(latLng);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });

            // Mettre à jour les textarea avec les coordonnées
            var latInput = document.getElementById('lat');
            var lngInput = document.getElementById('lng');
            latInput.value = points.map(point => point.lat()).join('\n');
            lngInput.value = points.map(point => point.lng()).join('\n');
        }

        // Récupérez les informations du propriétaire à partir de l'élément td


        document.getElementById('Géolocaliser').addEventListener('click', function() {
            var infowindow = new google.maps.InfoWindow();

            function afficherProprietaire(terrainId) {
                var nomProprietaire = ownerNames[terrainId];

                if (nomProprietaire) {
                    var content = 'Nom du propriétaire : ' + nomProprietaire;
                    infowindow.setContent(content);
                    var polygon = polygons.find(function(item) {
                        return item.id === terrainId;
                    });

                    if (polygon) {
                        var polygonBounds = new google.maps.LatLngBounds();
                        polygon.coordinates.forEach(function(coordinate) {
                            polygonBounds.extend(coordinate);
                        });

                        // Positionnez l'infobulle au centre du polygone
                        infowindow.setPosition(polygonBounds.getCenter());

                        // Ouvrez l'infobulle sur la carte
                        infowindow.open(map);
                    }
                }
            }

            // ...

            var ownerNames = {}; // Un objet pour stocker les noms de propriétaires par terrainId

            var elements = document.querySelectorAll('[data-id]');
            elements.forEach(function(element) {
                var terrainId = element.getAttribute('data-id');
                // Effectuer une requête AJAX pour récupérer les données depuis la base de données
                $.ajax({
                    url: '/api/show/' + terrainId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Assurez-vous que les données de latitude, longitude et ownerName existent dans le résultat
                        if (data.lat && data.lng && data.name) {
                            var latitudes = data.lat.split('\r\n');
                            var longitudes = data.lng.split('\r\n');

                            // Vérifiez que les données de latitude et de longitude ont la même longueur
                            if (latitudes.length === longitudes.length) {
                                var coordinates = [];

                                // Créez un tableau d'objets LatLng à partir des données
                                for (var i = 0; i < latitudes.length; i++) {
                                    var lat = parseFloat(latitudes[i]);
                                    var lng = parseFloat(longitudes[i]);

                                    if (!isNaN(lat) && !isNaN(lng)) {
                                        coordinates.push({ lat: lat, lng: lng });
                                    }
                                }

                                // Créez un polygone à partir des coordonnées
                                const newPolygon = new google.maps.Polygon({
                                    paths: coordinates,
                                    strokeColor: '#ea1042',
                                    strokeOpacity: 0.8,
                                    strokeWeight: 2,
                                    fillColor: '#1a7429',
                                    fillOpacity: 0.35
                                });

                                // Stockez le nom du propriétaire associé à ce terrainId
                                ownerNames[terrainId] = data.name;

                                // Ajoutez le polygone à la carte
                                newPolygon.setMap(map);

                                // Associez le terrainId au polygone en tant que propriété personnalisée
                                newPolygon.terrainId = terrainId;

                                // Ajoutez un gestionnaire de clic pour le polygone
                                newPolygon.addListener('click', function() {
                                    afficherProprietaire(this.terrainId);
                                });

                                // Sauvegardez le polygone dans le stockage local
                                polygons.push({ id: terrainId, polygon: newPolygon, coordinates: coordinates });
                                localStorage.setItem('polygons', JSON.stringify(polygons));
                            }
                        }
                    },
                    error: function(error) {
                        console.error('Erreur lors de la récupération des données : ', error);
                    }
                });
            });
        });
    </script>


</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>No</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>propriétaire</th>
                @if (auth()->user()->level == 'Admin')
                    <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @php($no = 1)
            @foreach ($data as $row)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td data-id="{{ $row->id }}" hidden="hidden">{{ $row->id }}</td>
                    <td data-lat="{{ $row->lat }}">{{ $row->lat }}</td>
                    <td data-lng="{{ $row->lng }}">{{ $row->lng }}</td>
                    <td data-name="{{ $row->name }}">{{ $row->name }}</td>
                    @if (auth()->user()->level == 'Admin')
                        <td>
                            <a href="{{ route('terrains.delete', $row->id) }}" class="btn btn-danger">Supprimer</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>




<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsDu3_rx4tO81YczzsN1qukrawSrngk3s&callback=initMap"></script>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/chart.js/Chart.min.js') }}"></script>
</body>
</html>
