<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CampsiteSpot;

class CampsiteSpotDate extends Model
{
    use HasFactory;

    public function campsiteSpot() {
        return $this->belongsTo(CampsiteSpot::Class);
    }
}
