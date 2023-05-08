<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * @OA\Schema(
     *  schema="PageResource",
     *  title="PageResource",
     *  type="object",
     *  @OA\Property(
     *       property="status",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *  ),
     *  @OA\Property(
     *      property="data",
     *      description="out data",
     *      type="object",
     *      ref="#/components/schemas/PageDet"
     *  ),
     * )
     *
     * @OA\Schema(
     *  schema="PageDet",
     *  title="PageObject",
     *  type="object",
     *  @OA\Property(
     *       property="page",
     *       type="object",
     *      ref="#/components/schemas/PageObject"
     *  ),
     * )
     *
     * @OA\Schema(
     *  schema="PageObject",
     *  title="PageObject",
     *  type="object",
     *  @OA\Property(
     *       property="id",
     *       format="int32",
     *       type="integer",
     *       description="id",
     *  ),
     *  @OA\Property(
     *       property="title",
     *       type="string",
     *       description="title",
     *  ),
     *  @OA\Property(
     *       property="text",
     *       type="string",
     *       description="text",
     *  ),
     * )
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
