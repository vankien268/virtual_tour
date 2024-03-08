<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "settings";
    protected $fillable = ['location_id', 'language_id', 'key', 'value'];

    //relationship
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
