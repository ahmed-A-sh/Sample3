<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends JsonResource
{
    /**
     * @OA\Schema(
     *  schema="Status",
     *  title="Response Status Information",
     *  type="object",
     *  @OA\Property(
     *       property="success",
     *       type="boolean",
     *       description="Boolean value that specifies if transaction passed successfully or not",
     *      default="true"
     *  ),
     *  @OA\Property(
     *       property="message",
     *       type="string",
     *       nullable=true,
     *       description="Message that need to be shown to end users if Success is not true",
     *     default=""
     *  ),
     * )
     * @OA\Schema(
     *  schema="Page",
     *  title="Response Status Information",
     *  type="object",
     *  @OA\Property(
     *       property="TotalRecords",
     *       format="int32",
     *       type="integer",
     *       description="TotalRecords",
     *  ),

     *  @OA\Property(
     *       property="PagesCount",
     *       format="int32",
     *       type="integer",
     *       description="PagesCount",
     *  ),

     *  @OA\Property(
     *       property="PageNo",
     *       format="int32",
     *       type="integer",
     *       description="PageNo",
     *  ),

     *  @OA\Property(
     *       property="PageSize",
     *       format="int32",
     *       type="integer",
     *       description="PageSize",
     *  ),

     * )
     *   @OA\Parameter(
     *          name="language",
     *          description="resopnse language : ar for arabic || en for english",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *
     *   @OA\Parameter(
     *          name="device_key",
     *          description="device_key send to determine image liked or no",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *
     *
     * @OA\Schema(
     *  schema="NoData",
     *  title="NoData",
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
     *  ),
     * )
     *
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
