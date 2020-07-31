<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import file model Person
use App\Person;

class PersonController extends Controller
{

    // mengambil semua data
    public function all()
    {
        $persons = Person::paginate(2);
        return response()->json($persons);
    }

    // // mengambil data by id
    // public function show($id)
    // {
    //     return Person::find($id);
    // }

    // menambah data
    public function store()
    {
        $person = new Person;
        $person->name = request()->name;
        $person->email = request()->email;
        $person->password = request()->password;
        $person->save();
        return 'mantab';
        // return Person::create($request->all());
    }

    // // mengubah data
    // public function update($id, Request $request)
    // {
    //     $person = Person::find($id);
    //     $person->update($request->all());
    //     return $person;
    // }

    // // menghapus data
    // public function delete($id)
    // {
    //     $person = Person::find($id);
    //     $person->delete();
    //     return 204;
    // }
}
