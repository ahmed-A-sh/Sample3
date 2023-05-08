<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StepResource extends JsonResource
{

    /**
     * @OA\Schema(
     *  schema="StepResource",
     *  title="StepResource",
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
     *       property="description",
     *       type="string",
     *       description="description",
     *  ),
     *  @OA\Property(
     *       property="source",
     *       type="string",
     *       description="source",
     *  ),
     *  @OA\Property(
     *       property="image",
     *       type="string",
     *       description="image",
     *  ),
     *  @OA\Property(
     *       property="image_thumb",
     *       type="string",
     *       description="image_thumb",
     *  ),
     * )
     *    * @OA\Schema(
     *  schema="StepResponceResource",
     *  title="StepResponceResource",
     *  type="object",
     *  @OA\Property(
     *       property="status",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *  ),
     * @OA\Property(
     *       property="page",
     *       type="object",
     *       ref="#/components/schemas/Page"
     *  ),
     *  @OA\Property(
     *      property="data",
     *      description="out data",
     *      type="object",
     *      ref="#/components/schemas/StepResponceObject"
     *  ),
     * )
     *
     * @OA\Schema(
     *  schema="StepResponceObject",
     *  title="StepResponceObject",
     *  type="object",
     *  @OA\Property(
     *       property="steps",
     *        type="object",
     *         ref="#/components/schemas/StepResource"
     *  ),
     * )
     * */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'source'=>$this->source,
            'image'=>$this->image_url,
            'image_thumb'=>$this->image_thumb,

        ];
    }
}
