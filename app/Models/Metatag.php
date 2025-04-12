<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Metatag extends Model
{
    public function metatagable(): MorphTo
    {
        return $this->morphTo();
    }
}
