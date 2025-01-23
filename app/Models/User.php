<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code_verification',
        'user_tipo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rules(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ];
    } 
    
    public function feedback(){
        return [
            'name.required' => 'O campo nome deve ser preenchido.',
            'email.required' => 'O campo email deve ser preenchido.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'password.required' => 'O campo senha deve ser preenchido.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ];
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Supondo que o ID do usuário seja a chave primária da tabela de usuários
    }

    // Implemente o método getJWTCustomClaims()
    public function getJWTCustomClaims()
    {
        return []; // Você pode adicionar reivindicações personalizadas aqui, se necessário
    }

    public function EnderecoUser(): HasOne
    {
        return $this->hasOne(EnderecoUser::class, 'usuario_id', 'id');
    }
}
