<?php

namespace App\Http\Controllers\Api;


use App\Actions\ApiActions;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdviceResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ImageTypeResource;
use App\Http\Resources\TextResource;
use App\Http\Resources\TextTypeResource;
use App\Models\Advice;
use App\Models\Favorite;
use App\Models\SearchHistory;
use App\Models\ImageType;
use App\Models\Image;
use App\Models\Step;
use App\Models\Text;
use App\Models\TextType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class TextController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/advices",
     *      operationId="advices",
     *      tags={"TextsApiSection"},
     *      summary="Get advices API",
     *      description="Get advices service",
     *       @OA\Parameter(
     *          name="page",
     *          description="page to be viewed ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *            format="int32",
     *       type="integer",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page_size",
     *          description="page size def is 10 ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *             format="int32",
     *       type="integer",
     *          )
     *      ),
     *       @OA\Parameter(ref="#/components/parameters/language"),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *        @OA\JsonContent(ref="#/components/schemas/AdviceResponceResource"),
     *     ),
     * )
     */
    public function advices(Request $request)
    {

        $advices = Advice::where('status','enabled')->
        orderBy('id', 'desc')->paginate($request->get('page_size',10));
        $paging = $advices;
       $advices=AdviceResource::collection($advices);

        return ApiActions::generateResponse(compact('advices'), 'default_message', 200, $paging);
    }


    /**
     * @OA\Get(
     *      path="/api/steps",
     *      operationId="steps",
     *      tags={"TextsApiSection"},
     *      summary="Get steps API",
     *      description="Get steps service",
     *       @OA\Parameter(
     *          name="page",
     *          description="page to be viewed ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *            format="int32",
     *       type="integer",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page_size",
     *          description="page size def is 10 ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *             format="int32",
     *       type="integer",
     *          )
     *      ),
     *       @OA\Parameter(ref="#/components/parameters/language"),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *        @OA\JsonContent(ref="#/components/schemas/StepResponceResource"),
     *     ),
     * )
     */
    public function steps(Request $request)
    {

        $advices = Step::where('status','enabled')->
        orderBy('ordering', 'asc')->paginate($request->get('page_size',20));
        $paging = $advices;
       $advices=AdviceResource::collection($advices);

        return ApiActions::generateResponse(compact('advices'), 'default_message', 200, $paging);
    }



}
