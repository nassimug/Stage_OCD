@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold text-center">Connexion</h2>

    @if($errors->any())
        <p class="text-red-500 text-center mt-2">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="mt-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Se connecter</button>
    </form>

    <p class="text-center mt-4">
        Pas encore inscrit ? <a href="{{ route('register') }}" class="text-blue-600">Créer un compte</a>
    </p>
</div>
@endsection