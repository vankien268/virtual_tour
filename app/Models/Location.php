<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Location
 *
 * @property int $id
 * @property int|null $zone_id
 * @property string|null $name
 * @property string|null $address
 * @property float|null $lat
 * @property float|null $long
 * @property string|null $overview
 * @property int|null $position
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Location extends Model
{
    use HasFactory, SoftDeletes;
	protected $table = 'locations';

	protected $casts = [
		'zone_id' => 'int',
		'lat' => 'float',
		'long' => 'float',
		'position' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'zone_id',
		'name',
		'address',
		'lat',
		'long',
		'overview',
		'position',
		'status',
		'top'
	];

    public function relatedLoactions(){
        return $this->hasMany(RelatedLocation::class, 'location_id');
    }

    public function presentations(){
        return $this->hasMany(Presentation::class, 'location_id');
    }

	public function zone()
	{
		return $this->belongsTo(Zone::class, 'zone_id');
	}

    public function scannings()
    {
        return $this->hasMany(Scanning::class, 'location_id');
    }
}
