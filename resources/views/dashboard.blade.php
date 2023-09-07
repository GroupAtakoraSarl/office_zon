@extends('layouts.app')

@section('title', 'Syteme de Gestion Immobiliers')

@section('contents')
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-2"></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <style>
                        .narrow-table {
                            max-width: 400px;
                            margin: auto;
                        }
                        .narrow-table td {
                            width: 10%;
                            padding: 5px;
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered narrow-table">
                        <thead>
                        <tr align="center">
                            <th colspan="2"><h3>Statistiques Catégories</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5><i class="fa fa-list"></i> Nombre de Catégories</h5>
                            </td>
                            <td>{{ $categoryCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered narrow-table" style="margin-right: 20px;">
                        <thead>
                        <tr align="center">
                            <th colspan="2"><h3>Statistiques</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5><i class="fa fa-users"></i> Nombre d'utilisateurs </h5>
                            </td>
                            <td>{{ $AdminCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <style>
                        .narrow-table {
                            max-width: 400px;
                            margin: auto;
                        }
                        .narrow-table td {
                            width: 10%;
                            padding: 5px;
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered narrow-table" >
                        <thead>
                        <tr align="center">
                            <th colspan="2"><h3>Statistiques Reservation</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5><i class="fa fa-calendar"></i> Nombre de Reservation </h5>
                            </td>
                            <td>{{ $ReserCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered narrow-table" style="margin-right: 20px;">
                        <thead>
                        <tr align="center">
                            <th colspan="2"><h3>Publications des biens</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5><i class="fa fa-home"></i> Nombre de publications </h5>
                            </td>
                            <td>{{ $HomeCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <style>
                        .narrow-table {
                            max-width: 500px;
                            margin: auto;
                        }
                        .narrow-table td {
                            width: 10%;
                            padding: 5px;
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered narrow-table" >
                        <thead>
                        <tr align="center">
                            <th colspan="2"><h3>Visites</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5><i class="fa fa-eye"></i> Nombre de Visites </h5>
                            </td>
                            <td>{{ $VisiterCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
