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
 * Class Zone
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $overview
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Zone extends Model
{
    use HasFactory, SoftDeletes;
	protected $table = 'zones';

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'address',
		'overview',
		'status'
	];
}
