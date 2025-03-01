@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold text-center">Bienvenue sur le Dashboard</h2>

    <p class="text-center mt-4">
        Bonjour, {{ Auth::user()->name }} ! Voici votre espace personnel.
    </p>

    <div class="mt-6">
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="block text-center bg-red-600 text-white p-2 rounded">
           Déconnexion
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection