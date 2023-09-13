<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm" ></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">1+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Envoyer
                </h6>
                <a class="dropdown-item d-flex align-items-center black-background"  href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success" style="color: black;">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Aout 7, 2013</div>
                        maison non renouveler payé à $290.29 !
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">regarder tous les alerts</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">1</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Envoyer
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile_1.svg" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">! ! alerte j'ai besoin d'une maison vc et d'une douche interne.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">lire les messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                    <br>
                    <small>{{ auth()->user()->level }}</small>
                </span>
                <img class="img-profile rounded-circle" src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<style>
    #map {
        height: 400px;
    }
</style>
<div id="map"></div>
<script type="text/javascript">
    var map;
    var marker;

    function showMap(lat, lng) {
        var myLatLng = {
            lat: lat,
            lng: lng
        };
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        var infoWindowContent = "Bienvenue sur notre siège !";

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });

        var infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent
        });

        marker.addListener("click", function() {
            infoWindow.open(map, marker);
        });
    }


    function initMap() {

        var initialLat = 7.281255;
        var initialLng = 1.039647;
        showMap(initialLat, initialLng);
    }

    document.addEventListener("DOMContentLoaded", function (callback) {
        initMap();
        var positionCells = document.querySelectorAll('[data-position]');

        if (positionCells.length > 0) {
            var firstPosition = positionCells[0].getAttribute('data-position');
            var [firstLng, firstLat] = extractLngLatFromPosition(firstPosition);

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: { lat: parseFloat(firstLat), lng: parseFloat(firstLng) },
            });


            var markers = [];
            var infoWindow = new google.maps.InfoWindow();


            var elements = document.querySelectorAll('[data-id]');
            var id = Array.from(elements).map(function (element) {
                return element.getAttribute('data-id');
            });
            console.log(id);

            positionCells.forEach(function (cell, index) {
                // Récupérez l'ID pour cette itération de la boucle
                var houseId = id[index];

                var position = cell.getAttribute('data-position');
                var [lng, lat] = extractLngLatFromPosition(position);

                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(lat), lng: parseFloat(lng) },
                    map: map,
                });

                google.maps.event.addListener(marker, 'click', function () {
                    // Utilisation de la requête AJAX
                    $.ajax({
                        url: '/api/show/' + houseId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var content = getInfoWindowContent(data);
                            infoWindow.setContent(content);
                            infoWindow.open(map, marker);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                markers.push(marker);
            });


        } else {
            var defaultLat = 7.281255;
            var defaultLng = 1.039647;

            showMap(defaultLat, defaultLng);
        }

    });

    // ...

    function getInfoWindowContent(data) {
        return `
    <div>
        <strong>Item Code:</strong> ${data.item_code}<br>
        <strong>Localisation:</strong> ${data.localisation}<br>
        <strong>Description:</strong> ${data.description}<br>
        <strong><img src="storage/${data.path}" width="80" ><br></strong>
        <!-- Ajoutez d'autres champs de données ici -->
    </div>`;
    }



    function extractLngLatFromPosition(position) {
        var lng = parseFloat(position.match(/LNG(-?\d+\.\d+),LAT(-?\d+\.\d+)/)[1]);
        var lat = parseFloat(position.match(/LNG(-?\d+\.\d+),LAT(-?\d+\.\d+)/)[2]);
        return [lng, lat];
    }



</script>
