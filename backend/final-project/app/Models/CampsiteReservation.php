<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;
use App\Models\CampsiteSpot;

class CampsiteReservation extends Model
{
    use HasFactory;

    public function campsite() {
        $this->belongsTo(Campsite::Class);
    }

    public function campsiteSpot() {
        $this->belongsTo(CampsiteSpot::Class);
    }
}
