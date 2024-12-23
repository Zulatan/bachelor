<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Service extends Model
{
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
    protected $fillable = ['name', 'description'];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}
