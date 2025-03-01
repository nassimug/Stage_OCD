@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
        font-family: 'Arial', sans-serif;
    }
    .test {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        font-size: 26px;
        font-weight: bold;
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }
    h3 {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        color: #007bff;
    }
    p {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }
    strong {
        color: #333;
    }
   
    .btn-secondary {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
        margin-top: 20px;
    }
    .btn-secondary:hover {
        background: #5a6268;
    }
</style>

<div class="container test ">
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