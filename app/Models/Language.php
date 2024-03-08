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
 * Class Language
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $localization
 * @property string|null $code
 * @property int $status
 * @property int $default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Language extends Model
{
    use HasFactory, SoftDeletes;
	protected $table = 'languages';

	protected $casts = [
		'status' => 'int',
		'default' => 'int'
	];

	protected $fillable = [
		'name',
		'localization',
		'code',
		'status',
		'default'
	];

	public static function findByCode($code) {
	    $lang = static::query()->where('code', $code)->first();
	    return $lang;
    }

}
