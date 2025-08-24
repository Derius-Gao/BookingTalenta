<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Get the portfolios for the category.
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'id_kategori', 'id_kategori');
    }
}
