<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'brand'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(related: Brand::class);
    }

    public function requestDesign(): HasMany
    {
        return $this->hasMany(related: RequestDesign::class);
    }

    public function result():HasMany
    {
        return $this->hasMany(related:Result::class);
    }

    // public function result(): MorphToMany
    // {
    //     return $this->morphToMany(Result::class, 'brand');
    // }
}
