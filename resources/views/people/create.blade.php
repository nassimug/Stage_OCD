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
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .btn-success {
        width: 100%;
        padding: 14px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
    }
    .btn-success:hover {
        background: #218838;
    }
</style>

<div class="container test">
    <h1>Ajouter une nouvelle personne</h1>

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
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="birth_name" class="form-label">Nom de naissance</label>
            <input type="text" name="birth_name" class="form-control" value="{{ old('birth_name') }}">
        </div>
        <div class="mb-3">
            <label for="middle_names" class="form-label">Prénoms intermédiaires</label>
            <input type="text" name="middle_names" class="form-control" value="{{ old('middle_names') }}">
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date de naissance</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
