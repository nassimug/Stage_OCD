@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une nouvelle personne</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('people.store') }}" method="POST">
        @csrf

        {{-- Prénom --}}
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
        </div>

        {{-- Nom --}}
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
        </div>

        {{-- Nom de naissance --}}
        <div class="mb-3">
            <label for="birth_name" class="form-label">Nom de naissance</label>
            <input type="text" name="birth_name" class="form-control" value="{{ old('birth_name') }}">
        </div>

        {{-- Prénoms intermédiaires --}}
        <div class="mb-3">
            <label for="middle_names" class="form-label">Prénoms intermédiaires</label>
            <input type="text" name="middle_names" class="form-control" value="{{ old('middle_names') }}">
        </div>

        {{-- Date de naissance --}}
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date de naissance</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
        </div>

        {{-- Bouton de soumission --}}
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection