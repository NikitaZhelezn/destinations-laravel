<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class Destination;
 *
 * @property string $name;
 * @property float $lat;
 * @property float $lon;
 */
class Destination extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lat',
        'lon',
    ];

    /** @var bool  */
    public $timestamps = true;
}
