<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolio';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_portfolio';

    protected $fillable = [
        'id_talenta',
        'id_kategori',
        'judul',
        'deskripsi',
        'foto',
        'harga_minimal',
        'harga_maximal',
    ];

    /**
     * Get the talent that owns the portfolio.
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'id_talenta', 'id_talenta');
    }

    /**
     * Get the category that owns the portfolio.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Get the bookings for the portfolio.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_portfolio', 'id_portfolio');
    }
}
