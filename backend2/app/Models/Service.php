<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;

class Service extends Model
{
    use HasFactory;
    
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
    
        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Bookings::class, 'booking_service', 'service_id', 'booking_id');
    }
}
