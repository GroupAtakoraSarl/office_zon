@extends('layouts.app')

@section('title', 'Nos publications')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Operations</h6>
        </div>
        <div class="card-body">
            @if (auth()->user()->level == 'Admin')
                <a href="{{ route('homes.add') }}" class="btn btn-primary mb-3">Publier une maison</a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Localisation</th>
                        <th>Description</th>
                        <th>Salles de bains</th>
                        <th>Surface</th>
                        <th>Modèle</th>
                        <th>Image</th>
                        <th>Catégorie</th>
                        <th>Quartier</th>
                        <th>Prix</th>
                        <th>Position</th>
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
                            <td data-item_code="{{ $row->item_code }}">{{ $row->item_code }}</td>
                            <td data-localisation="{{ $row->localisation }}">{{ $row->localisation }}</td>
                            <td data-description="{{ $row->description }}">{{ $row->description }}</td>
                            <td data-bathrooms="{{ $row->bathrooms }}">{{ $row->bathrooms }}</td>
                            <td data-area="{{ $row->area }}">{{ $row->area }}</td>
                            <td data-model="{{ $row->model }}">{{ $row->model }}</td>
                            <td data-image_url="{{ asset('storage/' . $row->path) }}"><img src="{{ asset('storage/' . $row->path) }}" width="80"></td>
                            <td data-category="{{ $row->category }}">{{ $row->category }}</td>
                            <td data-quartier="{{ $row->quartier }}">{{ $row->quartier }}</td>
                            <td data-price="{{ $row->price }}">{{ $row->price }}</td>
                            <td data-position="{{ $row->position }}">{{ $row->position }}</td>
                            @if (auth()->user()->level == 'Admin')
                                <td>
                                    <a href="{{ route('homes.edit', $row->id) }}" class="btn btn-warning">Modifier</a>
                                    <a href="{{ route('homes.delete', $row->id) }}" class="btn btn-danger">Supprimer</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


