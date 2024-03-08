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
 * Class RelatedLocation
 *
 * @property int $id
 * @property int|null $location_id
 * @property int|null $related_location_id
 * @property int|null $position
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RelatedLocation extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'related_locations';

	protected $casts = [
		'location_id' => 'int',
		'related_location_id' => 'int',
		'position' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'location_id',
		'related_location_id',
		'position',
		'status'
	];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function related()
    {
        return $this->belongsTo(Location::class, 'related_location_id');
    }

}
