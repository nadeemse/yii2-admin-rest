<?php

namespace api\modules\swagger;
    /**
     * @SWG\Swagger(
     *     schemes={"http"},
     *     host="api.afrotopic.local",
     *     basePath="/v1",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="AD ARENA API documentation",
     *         description="Version: __1.0.0__",
     *         @SWG\Contact(name = "Nadeem Akhtar ", email = "nadeemakhtar.se@gmail.com")
     *     ),
     * )
     *
     * @SWG\Tag(
     *   name="user",
     *   description="About Swagger",
     *   @SWG\ExternalDocumentation(
     *     description="Find out more about our store",
     *     url="http://swagger.io"
     *   )
     * )
     */
/**
 * @SWG\Definition(
 *   @SWG\Xml(name="##default")
 * )
 */
class ApiResponse
{
    /**
     * @SWG\Property(format="int32", description = "code of result")
     * @var int
     */
    public $code;
    /**
     * @SWG\Property
     * @var string
     */
    public $type;
    /**
     * @SWG\Property
     * @var string
     */
    public $message;
    /**
     * @SWG\Property(format = "int64", enum = {1, 2})
     * @var integer
     */
    public $status;
}