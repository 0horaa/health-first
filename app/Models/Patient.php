<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $appends = [
        'status', //define uma forma de chamar o getStatusAttribute usando apenas uma propriedade chamada 'status'
        'color'
    ];

    protected $casts = [
        'symptoms' => 'array'
    ];

    protected $guarded = [
        'id',
        'created_at',
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

    protected function verifySymptoms($result1, $result2, $result3, $result4) {
        $symptoms = $this->attributes['symptoms'];

        if(isset($symptoms) && count(json_decode($symptoms)) <= 5) {
            return $result1;
        } else if(isset($symptoms) && count(json_decode($symptoms)) <= 8) {
            return $result2;
        } else if(isset($symptoms) && count(json_decode($symptoms)) > 8) {
            return $result3;
        } else {
            return $result4;
        }
    }

    public function getNameAttribute() {
        if(isset($this->attributes['social_name'])) {
            return $this->attributes['social_name'];
        } else {
            return $this->attributes['name'];
        }
    }

    public function getStatusAttribute() {
        return $this->verifySymptoms(
            'Sintomas insuficientes',
            'Potencial infectado',
            'Possível infectado',
            'Nenhum sintoma foi informado'
        );
    }

    public function getColorAttribute() {
        return $this->verifySymptoms(
            'card mb-3 text-white bg-success',
            'card mb-3 text-white bg-warning',
            'card mb-3 text-white bg-danger',
            'card mb-3 text-white bg-success'
        );
    }

}
