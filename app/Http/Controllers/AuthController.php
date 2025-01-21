<?php

namespace App\Http\Controllers;

use App\Mail\MensagemForgettenPasswordMail;
use App\Mail\MensagemTesteMail;
use App\Mail\MensagemVerificationCodeMail;
use App\Models\Login;
use App\Models\User;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function login(Request $request)
    {

        $credenciais =
            [
                'email' => $request->email,
                'password' => $request->password
            ];

        $token = auth("api")->attempt($credenciais);

        if ($token) {
            Session::put('token', $token);
            $user = JWTAuth::setToken($token)->authenticate();
            Session::put('nameUser', $user->name);
            Session::put('nameID', Crypt::encrypt($user->id));
            Session::flash('token2', $token);
            $cookie = cookie('tokewwdn', $token, 120); // 120 minutos de validade
            $request->session()->put("teste", "sdsddsds");
            return response()->json(['token' => $token])->cookie($cookie);
        } else {
            return response()->json(['erro' => 'Usuário ou senha inválido!'], 403);
        }
        return response()->json(['erro'=>'login']);
    }

    public function register(Request $request)
    {

        $request->validate($this->user->rules(), $this->user->feedback());
        $request->merge([
            'code_verification' => $this->gerarNumerosAleatorios()
        ]);
        $user = $this->user->create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "code_verification" => $request->code_verification
        ]);
        Mail::to($request->email)->send(new MensagemVerificationCodeMail($request->name, $request->code_verification));
        return response()->json($request, 201);
    }

    public function codeVerificationEmail(Request $request)
    {
        $request->merge([
            'code_verification' => $this->gerarNumerosAleatorios()
        ]);
        $user = User::where('email', $request->email)->first();
        $user->update([
            "code_verification" => $request->code_verification
        ]);
        Mail::to($request->email)->send(new MensagemVerificationCodeMail($request->name, $request->code_verification));
        return response()->json(['message' => 'Código de verificação enviado.', 'code_verification' => $request->code_verification], 200);
    }

    public function verifiedEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $data = now()->toDateTimeString();
        $user->update([
            'email_verified_at' => now(),
        ]);
        return response()->json(['message' => 'E-mail validado com sucesso.'], 200);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function gerarNumerosAleatorios()
    {
        $numeros = '';
        while (strlen($numeros) < 5) {
            $numero = rand(0, 9);
            $numeros .= $numero;
        }

        return $numeros;
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
    public function logout(Request $request)
    {
        auth("api")->logout();
        session()->forget('token');
        if (!$request->expectsJson()) {
            return redirect()->route('login');
        }
        
        return response()->json(["msg" => 'Logout foi realizado com sucesso!']);
    }

    public function forgettenPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            Mail::to($request->email)->send(new MensagemForgettenPasswordMail($request->email, $user->id));
            return response()->json(['message' => 'E-mail para configurar senha enviado com sucesso!'], 200);
        }
        return response()->json(['message' => 'E-mail não encontrado'], 403);
    }

    public function resetPassword(string $id)
    {
        $idUser = Crypt::decrypt($id);
        return view('reset-password', ['id' => $idUser]);        
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'Senha atualizada com sucesso!'], 200);

    }
}
