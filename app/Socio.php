<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socio extends Model
{

    use SoftDeletes;

    protected $table = "socios";

    protected $hidden = ["id_pessoa"];

    protected $dates = ['deleted_at'];

    public function pessoa()
    {
        return $this->belongsTo("App\Pessoa", "id_pessoa");
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($socio) {
            $socio->pessoa->delete();
        });
    }

}