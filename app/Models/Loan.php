<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use UuidModel;

    public $table = 'loans';

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
        'book_id',
        'siswa_id',
        'tgl_peminjaman',
        'deadline',
        'tgl_pengembalian',
        'is_returned',
        'code'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'siswa_id','id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id','id');
    }

}
