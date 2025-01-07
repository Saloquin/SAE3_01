<?php

namespace App\Http\Controllers;

use App\Models\API\Club;
use App\Models\API\Competence;
use App\Models\API\Formation;
use App\Models\API\Group;
use App\Models\API\Learn;
use App\Models\API\Lesson;
use App\Models\API\Level;
use App\Models\API\Mastery;
use App\Models\API\Skill;
use App\Models\API\Teach;
use App\Models\API\Uti;
use App\Models\API\Validation;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getClubs()
    {
        return response()->json(Club::all(), 200);
    }

    public function getClub($id)
    {
        $club = Club::find($id);
        if (!$club) {
            return response()->json(['error' => 'Club not found'], 404);
        }
        return response()->json($club, 200);
    }

    public function getCompetences()
    {
        return response()->json(Competence::all(), 200);
    }

    public function getCompetence($id)
    {
        $competence = Competence::find($id);
        if (!$competence) {
            return response()->json(['error' => 'Competence not found'], 404);
        }
        return response()->json($competence, 200);
    }

    public function getFormations()
    {
        return response()->json(Formation::with(['responsable', 'level', 'club'])->get(), 200);
    }

    public function getFormation($id)
    {
        $formation = Formation::with(['responsable', 'level', 'club'])->find($id);
        if (!$formation) {
            return response()->json(['error' => 'Formation not found'], 404);
        }
        return response()->json($formation, 200);
    }

    public function getUsers()
    {
        return response()->json(Uti::all(), 200);
    }

    public function getUser($id)
    {
        $user = Uti::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

    public function getLessons()
    {
        return response()->json(Lesson::with('formation')->get(), 200);
    }

    public function getLesson($id)
    {
        $lesson = Lesson::with('formation')->find($id);
        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }
        return response()->json($lesson, 200);
    }

    public function createEntity(Request $request, $modelName)
    {
        $modelClass = 'App\\Models\\API\\' . ucfirst($modelName);

        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entity = $modelClass::create($request->all());
        return response()->json($entity, 201);
    }

    public function updateEntity(Request $request, $modelName, $id)
    {
        $modelClass = 'App\\Models\\API\\' . ucfirst($modelName);

        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entity = $modelClass::find($id);
        if (!$entity) {
            return response()->json(['error' => ucfirst($modelName) . ' not found'], 404);
        }

        $entity->update($request->all());
        return response()->json($entity, 200);
    }

    public function deleteEntity($modelName, $id)
    {
        $modelClass = 'App\\Models\\API\\' . ucfirst($modelName);

        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entity = $modelClass::find($id);
        if (!$entity) {
            return response()->json(['error' => ucfirst($modelName) . ' not found'], 404);
        }

        $entity->delete();
        return response()->json(['message' => ucfirst($modelName) . ' deleted'], 200);
    }
}

