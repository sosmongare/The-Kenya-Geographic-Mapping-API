<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Constituency",
 *     description="Constituency model",
 *     @OA\Xml(
 *         name="Constituency"
 *     )
 * )
 */
class Constituency extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the constituency",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="County ID",
     *     description="ID of the county the constituency belongs to",
     *     example=1
     * )
     *
     * @var integer
     */
    public $county_id;

    /**
     * @OA\Property(
     *     title="Constituency Name",
     *     description="Name of the constituency",
     *     example="Westlands"
     * )
     *
     * @var string
     */
    public $constituency_name;

    protected $fillable = [
        'county_id', 'constituency_name'
    ];
}
