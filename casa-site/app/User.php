<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'descricao', 'foto', 'profissao', 'admin', 'telefone', 'aprovado', 'estado', 'projeto_id', 'nascimento', 'cidade'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static $estadosBrasileiros = [
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

    public function projeto() {
        return $this->belongsTo('App\Projeto');
    }

    public function noticia() {
        return $this->hasMany('App\Noticia');
    }

    public function sobre() {
        return $this->hasMany('App\Sobre');
    }

    public function evento() {
        return $this->hasMany('App\Evento');
    }

    public function getAge()
    {
        return Carbon::parse($this->attributes['nascimento'])->age;
    }

    public function newsletter() {
        return $this->oneToOne('App\Newsletter');
    }

    public function despesa(){
        return $this->hasMany('App\Despesa');
    }

}
