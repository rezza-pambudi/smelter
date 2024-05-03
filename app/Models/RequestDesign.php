<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class RequestDesign extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'email', 'pilih_form', 'brief', 'materi', 'brand', 'tipe'];

    // public function user():BelongsTo
    // {
    //     return $this->belongsTo(related:User::class);
    // }

    public function requestDesign():HasMany
    {
        return $this->hasMany(related:RequestDesign::class);
    }

    public function result():BelongsTo
    {
        return $this->belongsTo(related:Result::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(related:Brand::class);
    }
}

