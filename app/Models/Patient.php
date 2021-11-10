<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $appends = [
        'status' //define uma forma de chamar o getStatusAttribute usando apenas uma propriedade chamada 'status'
    ];

    protected $casts = [
        'symptoms' => 'array'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'avatar',
        'age',
        'phone',
        'cpf',
        'observation',
        'social_name',
        'symptoms'
    ];

    public function getNameAttribute() {
        if(isset($this->attributes['social_name'])) {
            return $this->attributes['social_name'];
        } else {
            return $this->attributes['name'];
        }
    }

    public function getStatusAttribute() {
        $symptoms = $this->attributes['symptoms'];

        if(isset($symptoms) && count(json_decode($symptoms)) <= 5) {
            return "Sintomas insuficientes";
        } else if(isset($symptoms) && count(json_decode($symptoms)) <= 8) {
            return "Potencial infectado";
        } else if(isset($symptoms) && count(json_decode($symptoms)) > 8) {
            return "Possível infectado";
        } else {
            return "Nenhum sintoma foi informado";
        }
    }

}
