<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FichaUser extends Pivot
{
    use HasFactory;

    const STATUS = ['Certificado','Finalizado','Pendiente','Preparado'];

    protected $table = "ficha_user";
    public $incrementing = true;

    protected $fillable = [
        'ficha_id',
        'user_id',
        'status'
    ];
}
