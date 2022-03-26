<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionStageType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = "production_stage_types";

    // Relationships
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'type_id');
    }
}
