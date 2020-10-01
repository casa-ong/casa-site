<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'descricao',
        'foto',
        'profissao',
        'admin',
        'telefone',
        'aprovado',
        'estado',
        'projeto_id',
        'nascimento',
        'cidade'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projeto()
    {
        return $this->belongsTo('App\Models\Projeto');
    }

    public function sobre()
    {
        return $this->hasMany('App\Models\Sobre');
    }

    public function publicacao()
    {
        return $this->hasMany('App\Models\Publicacao');
    }

    public function getAge()
    {
        return Carbon::parse($this->attributes['nascimento'])->age;
    }

    public function newsletter()
    {
        return $this->hasOne('App\Models\Newsletter');
    }

    public function despesa()
    {
        return $this->hasMany('App\Models\Despesa');
    }

    public function enquete()
    {
        return $this->hasMany('App\Models\Enquete');
    }

    public function sugestao()
    {
        return $this->hasMany('App\Models\Sugestao');
    }

    public static function getEstadosBrasileiros() 
    {
        return [
            ['AC','Acre'],
            ['AL','Alagoas'],
            ['AP','Amapá'],
            ['AM','Amazonas'],
            ['BA','Bahia'],
            ['CE','Ceará'],
            ['DF','Distrito Federal'],
            ['ES','Espírito Santo'],
            ['GO','Goiás'],
            ['MA','Maranhão'],
            ['MT','Mato Grosso'],
            ['MS','Mato Grosso do Sul'],
            ['MG','Minas Gerais'],
            ['PA','Pará'],
            ['PB','Paraíba'],
            ['PR','Paraná'],
            ['PE','Pernambuco'],
            ['PI','Piauí'],
            ['RJ','Rio de Janeiro'],
            ['RN','Rio Grande do Norte'],
            ['RS','Rio Grande do Sul'],
            ['RO','Rondônia'],
            ['RR','Roraima'],
            ['SC','Santa Catarina'],
            ['SP','São Paulo'],
            ['SE','Sergipe'],
            ['TO','Tocantins'],
        ];
    }
}
