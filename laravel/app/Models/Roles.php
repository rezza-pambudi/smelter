<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'roles', 'guard_names'];

    public function Roles(): BelongsTo
    {
        return $this->belongsTo(related: Roles::class);
    }

    public function User():HasMany
    {
        return $this->hasMany(related:User::class);
    }
}
