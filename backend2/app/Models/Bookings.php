<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookings extends Model
{
    use HasFactory;
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
        'user_id',
        'scheduled_time',
        'status',
    ];

    protected $dates = ['deleted_at'];

    
    protected $casts = [ // casting = converting one data type to another
        'scheduled_time' => 'datetime',
        'accepted' => 'boolean',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function service()
    // {
    //     return $this->belongsTo(Service::class, 'service_id');
    // }
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service', 'booking_id', 'service_id');
    }

}
