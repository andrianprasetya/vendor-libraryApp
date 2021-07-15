<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Model District.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @package \App\Models
 * @copyright  (c) 2019, Pribumi Technology
 */
class District extends Model
{
    use UuidModel;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'districts';

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
        'regency_id',
        'name'
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
