<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Scanning
 * 
 * @property int $id
 * @property int|null $zone_id
 * @property int|null $location_id
 * @property int|null $presentation_id
 * @property int|null $language_id
 * @property Carbon|null $scanned_at
 * @property string|null $ip
 * @property string|null $user_agent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Scanning extends Model
{
	use SoftDeletes;
	protected $table = 'scannings';

	protected $casts = [
		'zone_id' => 'int',
		'location_id' => 'int',
		'presentation_id' => 'int',
		'language_id' => 'int'
	];

	protected $dates = [
		'scanned_at'
	];

	protected $fillable = [
		'zone_id',
		'location_id',
		'presentation_id',
		'language_id',
		'scanned_at',
		'ip',
		'user_agent'
	];
}
