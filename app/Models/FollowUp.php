<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_ps_date',
        'end_ps_date',
        'cod_company',
        'name_company',
        'address_company',
        'name_boss',
        'email_boss',
        'phone_boss',
        'town',
        'dependency',
        'status',
        'first_visit',
        'first_observation',
        'second_visit',
        'second_observation',
        'type_id',
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
