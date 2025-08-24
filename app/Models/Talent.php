<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talenta';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_talenta';

    protected $fillable = [
        'user_id',
        'no_hp',
        'spesialisasi',
    ];

    /**
     * Get the user that owns the talent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the portfolios for the talent.
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'id_talenta', 'id_talenta');
    }

    /**
     * Get the bookings for the talent.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_talenta', 'id_talenta');
    }

    /**
     * Get the ratings for the talent.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_talenta', 'id_talenta');
    }
}
