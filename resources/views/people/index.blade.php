@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Personnes</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
    <a href="{{ route('people.create') }}" class="btn btn-primary mb-3">Ajouter une Personne</a>
    @endauth

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($people as $person)
                <tr>
                    <td>{{ $person->first_name }}</td>
                    <td>{{ $person->last_name }}</td>
                    <td>{{ $person->date_of_birth ? $person->date_of_birth : 'Non renseigné' }}</td>
                    <td>
                        <a href="{{ route('people.show', $person->id) }}" class="btn btn-info">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   <div class="d-flex justify-content-center mt-4">
        {{ $people->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection