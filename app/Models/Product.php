<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{

    use LogsActivity;
    protected $guarded = [];


     
public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price', 'description']) 
            ->useLogName('product')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => " {$eventName} product: {$this->name}");
    }
}
