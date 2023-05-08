<?php
namespace App\Http\Controllers\Api;



use App\Actions\ApiActions;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConfigrationResource;
use App\Models\Country;
use App\Models\Emoji;
use App\Models\Page;
use App\Models\SearchHistory;
use App\Models\Settings;
use Illuminate\Http\Request;


class GeneralController extends Controller
{

    /**
     *
     *  @OA\Info(
     *     description="Pregnancy API Documentation",
     *     version="1.0.0",
     *     title="Pregnancy API swagger documentation",
     *     termsOfService="http://swagger.io/terms/",
     *     @OA\Contact(
     *         email="a@a.net"
     *     ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     * @OA\SecurityScheme(
     *     type="http",
     *     in="header",
     *     securityScheme="api_key",
     *     scheme="bearer"
     * )
     * @OA\Tag(
     *     name="GeneralApiSection",
     *     description="API Package for retrieving data requests",
     * )
     * @OA\Tag(
     *     name="TextApiSection",
     *     description="API Package for retrieving data requests",
     * )
     *
     *
     *
     *
     *
     *

     */
    public function get_configuration(){
        $top_search=ConfigrationResource::collection(SearchHistory::orderBy('search_count','desc')->orderBy('id','desc')->take(5)->get());

        return ApiActions::generateResponse(compact('top_search'));
    }

    /**
     * @OA\Get(
     *      path="/api/page/{page_id}",
     *      operationId="pages",
     *      tags={"GeneralApiSection"},
     *      summary="Get Static Pages  API",
     *      description="Get Pages service : Terms and Conditions id  = 1 || Privacy and Policies id  = 2 || About Us id  = 3 ",
     *      @OA\Parameter(
     *          name="page_id",
     *          description="page_id ::: Terms and Conditions id  = 1 || Privacy and Policies id  = 2 || About Us id  = 3 ",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(ref="#/components/parameters/language"),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *        @OA\JsonContent(ref="#/components/schemas/PageResource"),
     *     ),
     * )
     */
    public function get_page(Request $request,$page_id){

//        $pages =
//            [
//                [
//                    'title' => ['ar'=>'الشروط والاحكام','en'=>'Terms and Conditions'],
//                    'text' => [
//                        'ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور',
//                        'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. '
//
//                    ],
//                ],
//                [
//                    'title' => ['ar'=>'الخصوصية والسياسات','en'=>'Privacy and Policies'],
//                    'text' => [
//                        'ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور',
//                        'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. '
//                    ],
//                ],
//            ];
//
//        foreach ($pages as $page) {
//            Page::query()->create($page);
//        }
        $page = Page::where('id' , $page_id )->first();
        return ApiActions::generateResponse(compact('page'));

    }
}
