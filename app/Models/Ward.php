<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Ward",
 *     description="Ward model",
 *     @OA\Xml(
 *         name="Ward"
 *     )
 * )
 */
class Ward extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the ward",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="Constituency ID",
     *     description="ID of the constituency the ward belongs to",
     *     example=1
     * )
     *
     * @var integer
     */
    public $constituency_id;

    /**
     * @OA\Property(
     *     title="Ward Name",
     *     description="Name of the ward",
     *     example="Parklands"
     * )
     *
     * @var string
     */
    public $ward_name;

    protected $fillable = [
        'constituency_id','ward_name','updated_at', 'created_at'
    ];
}