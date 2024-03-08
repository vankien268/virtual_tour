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
 * Class Presentation
 *
 * @property int $id
 * @property int|null $location_id
 * @property int|null $language_id
 * @property string|null $language_code
 * @property string|null $name
 * @property string|null $overview
 * @property string|null $content
 * @property string|null $audio
 * @property string|null $video
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Presentation extends Model
{
    use HasFactory, SoftDeletes;
	protected $table = 'presentations';

	protected $casts = [
		'location_id' => 'int',
		'language_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'location_id',
		'language_id',
		'language_code',
		'name',
		'overview',
		'content',
		'audio',
		'video',
		'image',
		'status',
		'position'
	];

	//relationship
    public function location(){
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function language(){
        return $this->belongsTo(Language::class, 'language_id');
    }

}
