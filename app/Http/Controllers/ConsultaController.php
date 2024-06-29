<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta = Transacoes::all();
        return view('consulta.index', compact('consulta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mensagens = [
            'name.required' => __('Name is Mandatory'),
            'required' => __(':Attribute is required!'),
            //  'empresa_id.required' => 'Empresa é obrigatório!',
            //  'tipousuario_id.required' => 'Tipo da Empresa é obrigatório!',
            'email.email' => __('Enter a valid email address!'),
            'confirmed' => 'As senhas não coincidem!',
            'password_confirmation.required' => 'Confirmação da Senha é obrigatória!',
            'password.min' => 'A senha deve conter mais do que 6 caracteres ',
            'email.unique' => 'O email já está sendo usado',
        ];
        $data = $request->all();

        $validator = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            // 'empresa_id' => 'required',
            //'tipousuario_id' => 'required',
        ], $mensagens);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $users = User::all();
        return view('user.index', compact('users'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::where('id', $id)->first();

        if ($usuario) {
            return view('user.edit', compact('usuario'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::where('id', $id)->first();

        $mensagens = [
            'required' => ':Attribute é obrigatório!',
            'confirmed' => 'As senhas não coincidem!',
            'password_confirmation.required' => 'Confirmação da Senha é obrigatória!',
        ];

        $validator = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email',
                Rule::unique('users')->ignore(auth()->id())->where(function ($query) use ($usuario) {
                    return $query->where('email', '!=', $usuario->email);
                }),

            ],
            'password' => 'confirmed',
        ], $mensagens);

        if ($usuario) {
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');

            if (!empty($request->password)) {
                $usuario->password = Hash::make($request->input('password'));
            }
            // empty($usuario->uuid) ? $usuario->uuid = Uuid::uuid4() : null;
            // if ($request->hasFile('uuid')) {
            //     $file = $request->file('uuid');
            //     // $extension = $file->getClientOriginalExtension();
            //     $filename = $usuario->uuid;
            //     $file->move(public_path('uploads/imagem/'), $filename);
            //     $usuario->uuid = $filename;
            // }
            $usuario->update();

            return redirect()->route('user.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    public function save_transacao(Request $request) {

        $client = new \GuzzleHttp\Client(['headers' => ['api-key' => 'HACKATON_UNIESP_MARJO_2024']]);

        $response = $client->request('POST', 'https://hackathon.marjosports.com.br/hackathon', ['json' => ['cpf' => $request->cpf,'valor' => $request->valor ]]);
        return response()->json(['status' => 'ok']);
    }
}
