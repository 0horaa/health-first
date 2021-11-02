<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;
use PDOException;

class PatientController extends Controller
{
    public function index() {
        $patients = Patient::all();

        $search = request('search');

        if($search) {
            $patients = Patient::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $patients = Patient::all();
        }

        return view('welcome', ['patients' => $patients, 'search' => $search]);
    }

    public function store(Request $request) {
        $patient = new Patient();

        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->cpf = $request->cpf;
        $patient->observation = $request->observation ? $request->observation : "";
        $patient->social_name = $request->social_name;
        $patient->symptoms = $request->symptoms;

        if(isset($request->symptoms) && count($request->symptoms) <= 5) {
            $patient->status = "Sintomas insuficientes";
        } else if(isset($request->symptoms) && count($request->symptoms) <= 8) {
            $patient->status = "Potencial infectado";
        } else if(isset($request->symptoms) && count($request->symptoms) > 8) {
            $patient->status = "Possível infectado";
        } else {
            $patient->status = "Nenhum sintoma foi informado";
        }


        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $requestAvatar = $request -> avatar;

            $extension = $requestAvatar->extension();
            $avatarName = md5(
                $requestAvatar->getClientOriginalName() . strtotime('now')
            ) . ".$extension";

            $requestAvatar->move(public_path('img/avatars'), $avatarName);

            $patient->avatar = $avatarName;
        }

        $patient->save();

        return redirect('/')->with('msg', 'Paciente cadastrado com sucesso!');
    }

    public function show($id) {
        $patient = Patient::findOrFail($id);

        return view('show', ['patient' => $patient]);
    }

    public function update(Request $request) {
        $data = $request->all();

        if(isset($request->symptoms) && count($request->symptoms) <= 5) {
            $data['status'] = "Sintomas insuficientes";
        } else if(isset($request->symptoms) && count($request->symptoms) <= 8) {
            $data['status'] = "Potencial infectado";
        } else if(isset($request->symptoms) && count($request->symptoms) > 8) {
            $data['status'] = "Possível infectado";
        } else {
            $data['status'] = "Nenhum sintoma foi informado";
            $data['symptoms'] = [];
        }

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $requestAvatar = $request->avatar;

            $extension = $requestAvatar->extension();
            $avatarName = md5(
                $requestAvatar->getClientOriginalName() . strtotime('now')
            ) . ".$extension";

            $requestAvatar->move(public_path('img/avatars'), $avatarName);

            $data['avatar'] = $avatarName;
        }

        Patient::findOrFail($request->id)->update($data);

        return back()->with('msg', 'Perfil de usuário atualizado com sucesso!');
    }

    public function destroy($id) {
        Patient::findOrFail($id)->delete();
        return redirect('/')->with('msg', 'Perfil de paciente excluído com sucesso!');
    }
}
