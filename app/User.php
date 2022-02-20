<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Company;
use App\City;
use App\QuoteCandidate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'city_id',
        'phone',
        'street',
        'cpf',
        'birth',
        'number',
        'complement',
        'destrict',
        'cep',
        'cpf',
        'birth',
        'city_name', 
        'uf',
        'id'
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

    public function companies()
    {
        return $this->hasMany(Company::class, 'owner_id', 'id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function ads()
    {
        return $this->hasMany(Advert::class, 'user_id', 'id');
    }

    public function accepts()
    {
        return $this->hasMany(QuoteCandidate::class, 'user_id', 'id')->where('accepted_proposal','ACCEPT' ); // pode faze o where direto aqui se for fixado
    }
}
