<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'program_id',
        'code',
        'start_school_stage',
        'end_school_stage',
        'start_production_stage',
        'end_production_stage',
        'type',
        'town'
    ];

    protected $casts = [
        'start_school_stage' => 'datetime',
        'end_school_stage' => 'datetime',
        'start_production_stage' => 'datetime',
        'end_production_stage' => 'datetime',
    ];

    // Relationships

    /**
     * Users 
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'ficha_user')->using(FichaUser::class)->withPivot('status');
    }

    /**
     * 1 - n inversa 
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
