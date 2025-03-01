<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'created_by',
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
    ];

    /**
     * Relation : Une personne est créée par un utilisateur.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation : Une personne peut avoir plusieurs enfants.
     */
    public function children()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'parent_id', 'child_id');
    }

    /**
     * Relation : Une personne peut avoir plusieurs parents.
     */
    public function parents()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'child_id', 'parent_id');
    }

    /**
     * Trouve le degré de parenté et le chemin le plus court entre cette personne et une autre.
     *
     * @param int $target_person_id L'ID de la personne cible
     * @return array|false Tableau contenant ['degree' => int, 'path' => array] ou false si > 25 ou non trouvé
     */
    public function getDegreeWith($target_person_id)
    {
        // Si la personne ciblée est la même, degré = 0 et chemin direct
        if ($this->id == $target_person_id) {
            return ['degree' => 0, 'path' => [$this->id]];
        }

        // File d'attente pour le BFS : [person_id, degree, chemin]
        $queue = [[$this->id, 0, [$this->id]]];

        // Tableau pour éviter les doublons
        $visited = [$this->id => true];

        // Limite de recherche à 25 niveaux
        while (!empty($queue)) {
            [$current_id, $degree, $path] = array_shift($queue);

            // Si on dépasse 25 niveaux, on arrête
            if ($degree >= 25) {
                return false;
            }

            // Récupérer les relations parent -> enfant et enfant -> parent
            $relations = DB::select("
                SELECT parent_id, child_id 
                FROM relationships 
                WHERE parent_id = ? OR child_id = ?
            ", [$current_id, $current_id]);

            foreach ($relations as $relation) {
                // Identifier la personne reliée (éviter de revenir en arrière)
                $next_person = ($relation->parent_id == $current_id) ? $relation->child_id : $relation->parent_id;

                // Si on trouve la cible, on renvoie immédiatement le degré et le chemin
                if ($next_person == $target_person_id) {
                    return [
                        'degree' => $degree + 1,
                        'path' => array_merge($path, [$next_person])
                    ];
                }

                // Si la personne n’a pas encore été visitée, on l'ajoute à la file d'attente
                if (!isset($visited[$next_person])) {
                    $visited[$next_person] = true;
                    $queue[] = [$next_person, $degree + 1, array_merge($path, [$next_person])];
                }
            }
        }

        // Si on n’a pas trouvé, on renvoie false
        return false;
    }
}