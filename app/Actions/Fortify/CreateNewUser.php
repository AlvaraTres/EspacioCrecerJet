<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Freshwork\ChileanBundle\Rut;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        //Rut::parse($input['rut_paciente'])->quiet()->validate();

        Validator::make($input, [
            'rut_paciente' => ['required', 'cl_rut', 'unique:users'],
            'nombre_paciente' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-ZÑñ\s]+$/'],
            'apellido_pat_paciente' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-ZÑñ\s]+$/'],
            'apellido_mat_paciente' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-ZÑñ\s]+$/'],
            'fecha_nacimiento_paciente' => ['required'],
            'profesion' => ['required', 'string', 'max:255'],
            'patologias_previas' => ['max:255', 'min:5', 'regex:/^[a-zA-ZÑñ\s]+$/'],
            'telefono_paciente' => ['required', 'numeric', 'min:10000000', 'max:999999999'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $psicolist = DB::table('users')
                       ->leftjoin('pacientes', 'pacientes.id_psicologo', '=', 'users.id')
                       ->select('users.id as usuario', DB::raw('COUNT(pacientes.id) as pacientes'))
                       ->where('users.id_users_rol', '=', 2)
                       ->groupBy('usuario')
                       ->orderBy('pacientes', 'ASC')
                       ->first();
        //dd($psicolist);

        if(in_array('certificado', $input)){
            $paciente = Paciente::create([
                'id_psicologo' => $psicolist->usuario,
                'rut_paciente' => $input['rut_paciente'],
                'nombre_paciente' => $input['nombre_paciente'],
                'ap_pat_paciente' => $input['apellido_pat_paciente'],
                'ap_mat_paciente' => $input['apellido_mat_paciente'],
                'sexo_paciente' => $input['sexo_paciente'],
                'profesion' => $input['profesion'],
                'telefono_paciente' => $input['telefono_paciente'],
                'email' => $input['email'],
                'certificado' => null,
                'fecha_nacimiento_paciente' => Carbon::parse($input['fecha_nacimiento_paciente'])->format('Y-m-d'),
                'patologias_previas' => $input['patologias_previas'],
                'password' => Hash::make($input['password']),
            ]);
        }else{
            $paciente = Paciente::create([
                'id_psicologo' => $psicolist->usuario,
                'rut_paciente' => $input['rut_paciente'],
                'nombre_paciente' => $input['nombre_paciente'],
                'ap_pat_paciente' => $input['apellido_pat_paciente'],
                'ap_mat_paciente' => $input['apellido_mat_paciente'],
                'sexo_paciente' => $input['sexo_paciente'],
                'profesion' => $input['profesion'],
                'telefono_paciente' => $input['telefono_paciente'],
                'email' => $input['email'],
                'fecha_nacimiento_paciente' => Carbon::parse($input['fecha_nacimiento_paciente'])->format('Y-m-d'),
                'patologias_previas' => $input['patologias_previas'],
                'password' => Hash::make($input['password']),
            ]);
    
            $nombre = $paciente->nombre_paciente .' '.$paciente->ap_pat_paciente;
    
    
            if(in_array('certificado', $input)){
                $file = $input['certificado']->getClientOriginalName();
                //dd($file);
                $input['certificado']->storeAs('certificado/' . $nombre, $file);
                $paciente->update(['certificado' => $file]);
            }
        }

        /*
        User::create([
            'id_users_rol' => 3,
            'rut_usuario' => $input['rut_paciente'],
            'nombre_usuario' => $input['nombre_paciente'],
            'apellido_pat_usuario' => $input['apellido_pat_paciente'],
            'apellido_mat_usuario' => $input['apellido_mat_paciente'],
            'telefono' => $input['telefono_paciente'],
            'email' => $input['email'],
            'especialidad' => 'ninguna',
            'fecha_nacimiento' => Carbon::parse($input['fecha_nacimiento_paciente'])->format('Y-m-d'),
            'password' => Hash::make($input['password']),
        ]);

        return view('dashboard');*/

        
        
        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'id_users_rol' => 3,
                'rut_usuario' => $input['rut_paciente'],
                'nombre_usuario' => $input['nombre_paciente'],
                'apellido_pat_usuario' => $input['apellido_pat_paciente'],
                'apellido_mat_usuario' => $input['apellido_mat_paciente'],
                'sexo' => $input['sexo_paciente'],
                'telefono' => $input['telefono_paciente'],
                'email' => $input['email'],
                'formacion' => 'ninguna',
                'fecha_nacimiento' => Carbon::parse($input['fecha_nacimiento_paciente'])->format('Y-m-d'),
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
