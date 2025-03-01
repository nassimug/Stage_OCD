@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de {{ $person->first_name }} {{ $person->last_name }}</h1>

    <p><strong>Nom de naissance :</strong> {{ $person->birth_name }}</p>
    <p><strong>Prénoms intermédiaires :</strong> {{ $person->middle_names ?? 'N/A' }}</p>
    <p><strong>Date de naissance :</strong> {{ $person->date_of_birth ?? 'Non renseignée' }}</p>
    <p><strong>Créé par :</strong> {{ $person->createdBy->name ?? 'Inconnu' }}</p>

    <h3>Parents</h3>
    <ul>
        @foreach($person->parents as $parent)
            <li>{{ $parent->first_name }} {{ $parent->last_name }}</li>
        @endforeach
    </ul>

    <h3>Enfants</h3>
    <ul>
        @foreach($person->children as $child)
            <li>{{ $child->first_name }} {{ $child->last_name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('people.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection