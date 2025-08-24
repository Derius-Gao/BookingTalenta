<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rating';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_rating';

    protected $fillable = [
        'id_booking',
        'id_user',
        'id_talenta',
        'score_rating',
        'komentar',
    ];

    /**
     * Get the booking that owns the rating.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    /**
     * Get the user that owns the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the talent that owns the rating.
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'id_talenta', 'id_talenta');
    }
}
