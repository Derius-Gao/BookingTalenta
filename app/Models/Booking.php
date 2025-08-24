<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_user',
        'id_talenta',
        'id_portfolio',
        'deskripsi_acara',
        'lokasi_acara',
        'jumlah_harga',
        'status',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the talent that owns the booking.
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'id_talenta', 'id_talenta');
    }

    /**
     * Get the portfolio that owns the booking.
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'id_portfolio', 'id_portfolio');
    }

    /**
     * Get the payment for the booking.
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_booking', 'id_booking');
    }

    /**
     * Get the rating for the booking.
     */
    public function rating()
    {
        return $this->hasOne(Rating::class, 'id_booking', 'id_booking');
    }
}
