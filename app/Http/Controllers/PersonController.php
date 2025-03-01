<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    /**
     * Afficher la liste des personnes avec leur créateur.
     */
    public function index()
    {
        $people = Person::with('createdBy')->paginate(25); 
        return view('people.index', compact('people'));
    }

    /**
     * Afficher une personne spécifique avec ses enfants et parents.
     */
    public function show($id)
    {
        $person = Person::with(['children', 'parents', 'createdBy'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    /**
     * Afficher le formulaire de création d'une personne.
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Enregistrer une nouvelle personne.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
        ]);

        // Formatage des données
        $validatedData['created_by'] = Auth::id(); // ID de l'utilisateur authentifié

        // Première lettre en majuscule pour first_name
        $validatedData['first_name'] = ucfirst(strtolower($validatedData['first_name']));

        // Middle names : chaque prénom commence par une majuscule
        if (!empty($validatedData['middle_names'])) {
            $validatedData['middle_names'] = implode(', ', array_map('ucfirst', array_map('strtolower', explode(',', $validatedData['middle_names']))));
        } else {
            $validatedData['middle_names'] = null;
        }

        // Nom de famille en majuscules
        $validatedData['last_name'] = strtoupper($validatedData['last_name']);

        // Birth name : en majuscules, ou copie de last_name s'il est vide
        if (empty($validatedData['birth_name'])) {
            $validatedData['birth_name'] = $validatedData['last_name'];
        } else {
            $validatedData['birth_name'] = strtoupper($validatedData['birth_name']);
        }

        // Date de naissance : Null si vide
        $validatedData['date_of_birth'] = $validatedData['date_of_birth'] ?? null;

        // Création de la personne en base de données
        $person = Person::create($validatedData);

        return redirect()->route('people.index')->with('success', 'Personne ajoutée avec succès.');
    }
}