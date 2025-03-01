@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold text-center">Créer un compte</h2>

    @if ($errors->any())
        <p class="text-red-500 text-center mt-2">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ url('/register') }}" class="mt-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">S'inscrire</button>
    </form>

    <p class="text-center mt-4">
        Déjà un compte ? <a href="{{ route('login') }}" class="text-blue-600">Se connecter</a>
    </p>
</div>
@endsection