@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<style>
    body {
        background-color: #f3f4f6;
        font-family: 'Arial', sans-serif;
    }
    .register-container {
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
    .input-container {
        position: relative;
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
        border-color: #28a745;
        outline: none;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        bottom: 10px;
        cursor: pointer;
        color: #555;
        font-size: 18px;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }
    button:hover {
        background: #218838;
    }
    .login-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }
    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-container">
    <h2>Créer un compte</h2>

    @if ($errors->any())
        <p class="text-red-500 text-center mt-2">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ url('/register') }}" class="mt-6">
        @csrf
        <div class="mb-4">
            <label>Nom</label>
            <input type="text" name="name" required>
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="mb-4 input-container">
            <label>Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <span class="toggle-password" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <div class="mb-4 input-container">
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <button type="submit">S'inscrire</button>
    </form>

    <p class="login-link">
        Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
    </p>
</div>

<script>
    function togglePassword(id) {
        var input = document.getElementById(id);
        var icon = input.nextElementSibling.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
