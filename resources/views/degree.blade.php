@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
        font-family: 'Arial', sans-serif;
    }
    .test {
        max-width: 500px;
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
    label {
        font-weight: 600;
        color: #444;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
    }
    .btn-primary {
        width: 100%;
        padding: 14px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    .result-container {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
        margin-top: 20px;
    }
    .text-danger {
        color: #dc3545;
        font-weight: bold;
    }
</style>

<div class="container test">
    <h1>Calcul du degré de parenté</h1>

    <form action="{{ route('degree.check') }}" method="GET">
        @csrf
        <div class="mb-3">
            <label for="id1" class="form-label">ID de la première personne</label>
            <input type="number" name="id1" class="form-control" required value="{{ request('id1') }}">
        </div>

        <div class="mb-3">
            <label for="id2" class="form-label">ID de la seconde personne</label>
            <input type="number" name="id2" class="form-control" required value="{{ request('id2') }}">
        </div>

        <button type="submit" class="btn btn-primary">Vérifier le lien</button>
    </form>

    @if(isset($degree))
        <div class="result-container">
            <h3>Résultat :</h3>
            @if($degree === false)
                <p class="text-danger">Aucune relation trouvée entre {{ $id1 }} et {{ $id2 }} (ou degré > 25).</p>
            @else
                <p>Le degré de parenté entre <strong>{{ $id1 }}</strong> et <strong>{{ $id2 }}</strong> est : <strong>{{ $degree }}</strong></p>
                <p>Le chemin le plus court est : <strong>{{ implode(' → ', $path) }}</strong></p>
            @endif
        </div>
    @endif
</div>
@endsection