<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquenet\Relations\HasMany
use App\Models\CampsiteSpot;
use App\Models\CampsiteImage;
use App\Models\CampsiteReservation;

class Campsite extends Model
{
    use HasFactory;

    protected $table = 'campsites';

    public function campsiteImages() {
        $this->hasMany(campsiteImage::Class);
    }

    public function campsiteSpots() {
        $this->hasMany(CampsiteSpot::Class);
    }

    public function campsiteReservations() {
        $this->hasMany(CampsiteReservation::Class);
    }
}
