<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Metatag extends Model
{
    use HasFactory;

    public function metatagable(): MorphTo
    {
        return $this->morphTo();
    }
}
