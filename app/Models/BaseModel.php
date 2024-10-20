<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    use HasFactory, HasUuids;

    protected static function boot()
    {
        parent::boot();

        // listener on event 'creating'
        static::creating(function ($model) {

            $model->id = Uuid::uuid4()->toString();
        });
    }

    /*---------------------------------SERIALIZE-DATES---------------------------------*/

       /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::instance($date)->setTimezone('Europe/Rome')->toDateTimeString();
    }
}
