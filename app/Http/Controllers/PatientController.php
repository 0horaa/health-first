<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;

use App\Models\Patient;

class PatientController extends Controller
{
    public function index() {
        $patients = Patient::orderBy('id', 'DESC')->get();

        $search = request('search');

        if($search) {
            $patients = Patient::whereRaw("unaccent(name) ilike unaccent('%{$search}%')")->get();
        } else {
            $patients = Patient::orderBy('id', 'DESC')->get();
        }

        return view('welcome', ['patients' => $patients, 'search' => $search]);
    }

    public function store(PatientRequest $request) {
        $data = $request->validated();

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $requestAvatar = $request->avatar;

            $extension = $requestAvatar->extension();
            $avatarName = md5(
                $requestAvatar->getClientOriginalName() . strtotime('now')
            ) . ".$extension";

            $requestAvatar->move(public_path('img/avatars'), $avatarName);

            $data['avatar'] = $avatarName;
        }

        Patient::create($data);

        return redirect('/')->with('msg', 'Paciente cadastrado com sucesso!');
    }

    public function show($id) {
        $patient = Patient::findOrFail($id);

        return view('show', ['patient' => $patient]);
    }

    public function update(PatientRequest $request) {
        $data = $request->validated();

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $requestAvatar = $request->avatar;

            $extension = $requestAvatar->extension();
            $avatarName = md5(
                $requestAvatar->getClientOriginalName() . strtotime('now')
            ) . ".$extension";

            $requestAvatar->move(public_path('img/avatars'), $avatarName);

            $data['avatar'] = $avatarName;
        }

        if(!isset($data['symptoms'])) {
            $data['symptoms'] = null;
        }

        Patient::findOrFail($request->id)->update($data);

        return back()->with('msg', 'Perfil de usuário atualizado com sucesso!');
    }

    public function destroy($id) {
        Patient::findOrFail($id)->delete();
        return redirect('/')->with('msg', 'Perfil de paciente excluído com sucesso!');
    }
}
