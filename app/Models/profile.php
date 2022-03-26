<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class profile extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'document',
        'document_type',
        'names',
        'surnames',
        'phone',
        'direction',
        'birth_at',
        'user_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
