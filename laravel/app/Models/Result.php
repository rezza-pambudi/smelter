<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['id','email', 'pilih_form', 'designer', 'status', 'brand', 'hasil', 'brief', 'materi','tipe'];

    public function Result():HasMany
    {
        return $this->hasMany(related:Result::class);
    }

    public function requestDesign():HasMany
    {
        return $this->hasMany(related:RequestDesign::class);
    }

    public function brand():HasMany
    {
        return $this->hasMany(related:Brand::class);
    }

    // public function brand(): MorphMany
    // {
    //     return $this->morphMany(related:Brand::class);
    // }

    
}
