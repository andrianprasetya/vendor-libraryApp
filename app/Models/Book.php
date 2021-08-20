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
        'edition',
        'code',
        'collection',
        'location',
        'GMD',
        'media_type',
        'book_series',
        'publisher',
        'publishing_year',
        'publishing_place',
        'classification',
        'call_number',
        'language',
        'notes',
        'image',
        'file',];

}
