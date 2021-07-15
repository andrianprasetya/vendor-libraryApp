<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Regency.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @package \App\Models
 * @copyright  (c) 2019, Pribumi Technology
 */
class Regency extends Model
{
    use UuidModel;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'regencies';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'name'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
