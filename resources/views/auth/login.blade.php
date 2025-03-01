@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<style>
    body {
        background-color: #f3f4f6;
        font-family: 'Arial', sans-serif;
    }
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        color: #333;
    }
    label {
        font-weight: 600;
        color: #555;
    }
    input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: all 0.3s;
    }
    input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }
    button {
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }
    button:hover {
        background: #0056b3;
    }
    .register-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }
    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h2>Connexion</h2>

    @if($errors->any())
        <p class="text-red-500 text-center mt-2 text-sm">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="mt-6">
        @csrf
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="mb-4">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Se connecter</button>
    </form>

    <p class="register-link">
        Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a>
    </p>
</div>
@endsection