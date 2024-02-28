<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;
use App\Models\CampsiteSpotDate;

class CampsiteSpot extends Model
{
    use HasFactory;

    public function campsite() {
        return $this->belongsTo(Campsite::Class);
    }

    public function campsiteDates() {
        return $this->hasMany(CampsiteSpotDate::Class);
    }
}
