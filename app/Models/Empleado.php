<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['identification', 'first_name', 'last_name', 'phone', 'email', 'fk_department'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
