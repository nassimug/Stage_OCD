@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
        font-family: 'Arial', sans-serif;
    }
    .test {
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
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
    }
    .btn-primary {
        display: block;
        width: fit-content;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
        text-decoration: none;
        text-align: center;
        margin-bottom: 15px;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background: #007bff;
        color: white;
    }
    tr:hover {
        background: #f1f1f1;
    }
    .btn-info {
        padding: 8px 12px;
        background: #17a2b8;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
    }
    .btn-info:hover {
        background: #117a8b;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>

<div class="container test">
    <h1>Liste des Personnes</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
    <a href="{{ route('people.create') }}" class="btn btn-primary">Ajouter une Personne</a>
    @endauth

    <table>
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
   <div class="pagination">
        {{ $people->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection