<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use UuidModel;

    public $table = 'books';

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
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'author',
        'SOR',
        'edition',
        'SDI',
        'code_pattern_id',
        'total_item',
        'collection',
        'location',
        'GMD',
        'content_type',
        'media_type',
        'carrier_type',
        'frequency',
        'book_series',
        'publisher',
        'publishing_year',
        'publishing_place',
        'collation',
        'series_title',
        'classification',
        'call_number',
        'subject',
        'language',
        'notes',
        'image',
        'file',
        'biblio_data'];

    public function PatternCode()
    {
        return $this->belongsTo(PatternBook::class, 'code_pattern_id', 'id');
    }
}
