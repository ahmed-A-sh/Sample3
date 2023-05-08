<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdviceResource extends JsonResource
{

    /**
     * @OA\Schema(
     *  schema="AdviceResource",
     *  title="AdviceResource",
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
     *       property="youtube_url",
     *       type="string",
     *       description="youtube_url",
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
     *  schema="AdviceResponceResource",
     *  title="AdviceResponceResource",
     *  type="object",
     *  @OA\Property(
     *       property="status",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *  ),
     *  @OA\Property(
     *       property="page",
     *       type="object",
     *       ref="#/components/schemas/Page"
     *  ),
     *  @OA\Property(
     *      property="data",
     *      description="out data",
     *      type="object",
     *      ref="#/components/schemas/AdviceResponceObject"
     *  ),
     * )
     *
     * @OA\Schema(
     *  schema="AdviceResponceObject",
     *  title="AdviceResponceObject",
     *  type="object",
     *  @OA\Property(
     *       property="advices",
     *        type="object",
     *         ref="#/components/schemas/AdviceResource"
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
            'youtube_url'=>$this->youtube_url,
            'image'=>$this->image_url,
            'image_thumb'=>$this->image_thumb,

        ];
    }
}
