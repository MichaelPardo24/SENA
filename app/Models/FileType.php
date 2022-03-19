<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = "file_types";

    // Relationships
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
