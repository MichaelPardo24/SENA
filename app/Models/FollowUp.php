<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'start_date',
        'company_cod',
        'company_name',
        'company_address',
        'boss_name',
        'boss_phone',
        'boss_email',
        'town',
        'dependency',
        'status',
        'first_visit_date',
        'first_observation',
        'second_visit_date',
        'second_observation',
        'type_id',
        'ficha_id',
        'apprentice_id',
        'instructor_id',
    ];

    // RelationShips 
    public function type()
    {
        return $this->belongsTo(ProductionStageType::class, 'type_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function apprentice()
    {
        return $this->belongsTo(User::class, 'apprentice_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
