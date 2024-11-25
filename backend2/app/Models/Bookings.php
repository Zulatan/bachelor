<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    use SoftDeletes;
    public $timestamps = true; 


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer',
        'admin',
        'bookingTime',
        'accepted',
        'status',
    ];

    protected $dates = ['deleted_at'];

    
    protected function casts(): array // 'Casting' = converting one data type to another
    {
        return [
            'bookingTime'   => 'datetime',
            'accepted'      => 'boolean', // converts 1/0 to true/false
        ];
    }


    // The customer who made the booking and the admin that is providing the booked service
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer', 'id');
    }

    // The admin performing the service for the booking
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin', 'id');
    }


}
