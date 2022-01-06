<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path','origin'];

    public const FILE_ADMIN = 'CADASTRO_ADMIN';
    public const FILE_USER = 'CADASTRO_USER';


}
