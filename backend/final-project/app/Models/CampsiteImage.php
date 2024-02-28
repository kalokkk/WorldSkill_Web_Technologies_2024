<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;

class CampsiteImage extends Model
{
    use HasFactory;

    protected $table = 'campsite_images';

    public function campsite() {
        return $this->belongsTo(Campsite::Class);
    }
}
