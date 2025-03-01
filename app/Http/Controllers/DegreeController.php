<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'id1' => 'required|integer|exists:people,id',
            'id2' => 'required|integer|exists:people,id',
        ]);

        $id1 = $request->input('id1');
        $id2 = $request->input('id2');

        $person = Person::findOrFail($id1);
        $result = $person->getDegreeWith($id2);

        return view('degree', [
            'id1' => $id1,
            'id2' => $id2,
            'degree' => $result ? $result['degree'] : false,
            'path' => $result ? $result['path'] : []
        ]);
    }
}