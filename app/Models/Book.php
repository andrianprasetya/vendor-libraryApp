<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use UuidModel, SoftDeletes;

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
        'total_item',
        'gmd',
        'media_type',
        'book_series',
        'publisher',
        'publishing_year',
        'publishing_place',
        'classification',
        'call_number',
        'collection',
        'language',
        'notes',
        'image',
        'file',
        'slug_file',
        'sequence'];

    public function codes()
    {
        return $this->belongsToMany(PatternBook::class, 'code_books', 'book_id', 'pattern_book_id');
    }

    public function code_book(){
        return $this->hasMany(CodeBook::class, 'book_id','id');
    }
}
