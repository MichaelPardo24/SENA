<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'type_id',
        'fileable_id',
        'fileable_type'
    ];

    // Relationships
    public function type()
    {
        return $this->belongsTo(FileType::class, 'id', 'type_id');
    }

    /**
     * Relacion polimorfica con Users & FollowUps
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
