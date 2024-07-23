<?php

namespace App\Models;

use App\Models\Ward;
use App\Models\County;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'county_id', 'constituency_name','updated_at', 'created_at'
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
