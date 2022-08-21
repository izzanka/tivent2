<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getStartDate()
    {
        return Carbon::createFromFormat('Y-m-d',$this->start_date)->format('d M Y');
    }

    public function getStartTime()
    {
        return Carbon::createFromFormat('H:i:s',$this->start_time)->format('H:i');
    }


}
