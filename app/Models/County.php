<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="County",
 *     description="County model",
 *     @OA\Xml(
 *         name="County"
 *     )
 * )
 */

class County extends Model
{
    use HasFactory;

      /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the county",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="County Name",
     *     description="Name of the county",
     *     example="Nairobi"
     * )
     *
     * @var string
     */
    public $county_name;

    protected $fillable = [
        'county_name','updated_at', 'created_at'
    ];
}
