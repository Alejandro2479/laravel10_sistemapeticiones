<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Http\Requests\PeticionRequest;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NuevoDerechoPeticion;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $festivos = [
        '2024-01-01', '2024-01-08', '2024-03-25', '2024-03-28',
        '2024-03-29', '2024-05-01', '2024-05-13', '2024-06-03',
        '2024-06-10', '2024-07-01', '2024-07-20', '2024-08-07',
        '2024-08-19', '2024-10-14', '2024-11-04', '2024-11-11',
        '2024-12-08', '2024-12-25'
    ];

    public function indexPeticion(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', false)
            ->whereHas('users', function ($query) {
                $query->where('role', '!=', 'admin');
            })
            ->oldest()->paginate(10);

        return view('admin.index-peticion-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionCompleta(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', true)
            ->whereHas('users', function ($query) {
                $query->where('role', '!=', 'admin');
            })
            ->oldest()->paginate(10);

        return view('admin.index-peticion-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionDevuelta(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where([['user_id', $userId], ['estatus', false]])->oldest()->paginate(10);

        return view('admin.index-peticion-devuelta-admin', ['peticiones' => $peticiones]);
    }


    public function crearPeticion()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.crear-peticion-admin', ['users' => $users]);
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('admin.mostrar-peticion-admin', ['peticion' => $peticion]);
    }

    public function editarPeticion(Peticion $peticion)
    {
        $users = User::where('role', 'user')->get();
        $usuariosAsignados = $peticion->users->pluck('id')->toArray();

        return view('admin.editar-peticion-admin', ['peticion' => $peticion, 'users' => $users, 'usuariosAsignados' => $usuariosAsignados]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();

        // Definir los días según la categoría
        $diasPorCategoria = [
            'especial' => 5,
            'informacion' => 10,
            'general' => 15,
            'consulta' => 30,
        ];

        // Calcular la fecha de vencimiento
        $categoria = $data['categoria'];
        $dias = $diasPorCategoria[$categoria];

        // Obtener la fecha de creación
        $fechaVencimiento = Carbon::now();

        // Ajustar la fecha de vencimiento considerando fines de semana y días festivos
        for ($i = 0; $i < $dias; $i++) {
            $fechaVencimiento->addDay();
            while ($fechaVencimiento->isWeekend() || in_array($fechaVencimiento->toDateString(), $this->festivos)) {
                $fechaVencimiento->addDay();
            }
        }

        $data['fecha_vencimiento'] = $fechaVencimiento;
        $data['dias'] = $dias;

        // Crear la petición
        $peticion = Peticion::create($data);

        // Obtener los usuarios seleccionados
        $usuariosSeleccionados = $peticionRequest->input('user_id', []);

        // Asignar la petición a los usuarios seleccionados
        $peticion->users()->sync($usuariosSeleccionados);

        // Enviar notificación a cada usuario asignado
        foreach ($peticion->users as $user) {
            $user->notify(new NuevoDerechoPeticion($peticion->numero_radicado, $peticion->fecha_vencimiento));
        }

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición creada con éxito');
    }

    public function actualizarPeticion(Peticion $peticion, PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();

        // Definir los días según la categoría
        $diasPorCategoria = [
            'especial' => 5,
            'informacion' => 10,
            'general' => 15,
            'consulta' => 30,
        ];

        // Calcular la fecha de vencimiento
        $categoria = $data['categoria'];
        $dias = $diasPorCategoria[$categoria];

        // Obtener la fecha de creación
        $fechaVencimiento = Carbon::now();

        // Ajustar la fecha de vencimiento considerando fines de semana y días festivos
        for ($i = 0; $i < $dias; $i++) {
            $fechaVencimiento->addDay();
            while ($fechaVencimiento->isWeekend() || in_array($fechaVencimiento->toDateString(), $this->festivos)) {
                $fechaVencimiento->addDay();
            }
        }

        $data['fecha_vencimiento'] = $fechaVencimiento;
        $data['dias'] = $dias;

        // Actualizar los datos de la petición
        $peticion->update($data);

        // Obtener los usuarios seleccionados
        $usuariosSeleccionados = $peticionRequest->input('user_id', []);

        // Sincronizar los usuarios asignados a la petición
        $peticion->users()->sync($usuariosSeleccionados);

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición editada con éxito');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición eliminada con exito');
    }

    public function indexUser()
    {
        return view('admin.index-user-admin', ['users' => User::latest()->get()]);
    }

    public function crearUser()
    {
        return view('admin.crear-user-admin');
    }

    public function editarUser(User $user)
    {
        return view('admin.editar-user-admin', ['user' => $user]);
    }

    public function guardarUser(UserRequest $userRequest)
    {
        $peticion = User::create($userRequest->validated());

        return redirect()->route('admin.user-index')->with('exito', 'Usuario creado con exito');
    }

    public function actualizarUser(User $user, UserRequest $userRequest)
    {
        $user->update($userRequest->validated());

        return redirect()->route('admin.user-index')->with('exito', 'Usuario editado con exito');
    }

    public function eliminarUser(User $user)
    {
        if ($user->role !== 'admin') {
            $user->delete();
            return redirect()->route('admin.user-index')->with('exito', 'Usuario eliminado con éxito');
        } else {
            return redirect()->route('admin.user-index')->with('error', 'No se puede eliminar un administrador');
        }
    }
}
