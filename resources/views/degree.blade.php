@extends('layouts.app')

@section('content')
<div class="container">
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
        <div class="mt-4">
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