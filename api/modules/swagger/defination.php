<?php

namespace app\models\swagger;
    /**
     * @SWG\Definition(
     *      definition="Error",
     *      required={"code", "message"},
     *      @SWG\Property(
     *          property="code",
     *          type="integer",
     *          format="int32",
     *          example=401
     *      ),
     *      @SWG\Property(
     *          property="message",
     *          type="string",
     *          example="You are requesting with an invalid credential."
     *      )
     * )
     */
/**
 * @SWG\Definition(required={"id"}, @SWG\Xml(name="Id"))
 */
class Id
{
    /**
     * 用户ID
     *
     * @SWG\Property(example = 10000)
     *
     * @var integer
     */
    public $id;
}

/**
 * @SWG\Definition(required={"access_token", "username"}, @SWG\Xml(name="UserIdList"))
 */
class UserIdList
{
    /**
     * Access Token
     *
     * @SWG\Property()
     *
     * @var string
     */
    public $access_token;
    /**
     * @SWG\Property()
     *
     * @var Id[]
     */
    public $idList;
}


/**
 * @SWG\Definition(
 * required={
 * "name",
 * "price",
 * "category_id",
 * "area_id"
 * },
 * @SWG\Xml(name="Item"))
 */

class Item
{

    /**
     * Item Name
     * @SWG\Property(format="string")
     * @var string
     */
    public $name;

    /**
     * Item Price
     * @SWG\Property(format="string")
     * @var string
     */
    public $price;

    /**
     * Seller Id
     * @SWG\Property(format="integer")
     * @var integer
     */
    public $seller_id;

    /**
     * Category ID
     * @SWG\Property(format="integer")
     * @var integer
     */
    public $category_id;

    /**
     * Item Main Image
     * @SWG\Property(format="string")
     * @var string
     */
    public $description;

    /**
     * Discount
     * @SWG\Property(format="number", default="0")
     * @var number
     */
    public $status;

    /**
     * Discount
     * @SWG\Property(format="number", default="0")
     * @var number
     */
    public $visitCount;

    /**
     * Discount
     * @SWG\Property(format="number", default="0")
     * @var number
     */
    public $favoriteCount;


    /**
     * Discount
     * @SWG\Property(format="number", default="0")
     * @var number
     */
    public $isFeatured;

    /**
     * Discount
     * @SWG\Property(format="number")
     * @var number
     */
    public $area_id;

    /**
     * Discount
     * @SWG\Property(format="string")
     * @var string
     */
    public $latitude;

    /**
     * Discount
     * @SWG\Property(format="string")
     * @var string
     */
    public $longitude;

    /**
     * Payment Object
     * @SWG\Property(format="array", items={"$ref": "#/definitions/ItemImages"})
     * @var array
     */
    public $itemImages;

    /**
     * Payment Object
     * @SWG\Property(format="array", items={"$ref": "#/definitions/Filters"})
     * @var array
     */
    public $filters;

    /**
     * Payment Object
     * @SWG\Property(format="array", items={"$ref": "#/definitions/ItemCategory"})
     * @var array
     */
    public $item_categories;

}

/**
 * @SWG\Definition(
 * required={
 * "image"
 * },
 * @SWG\Xml(name="itemImages"))
 */

class itemImages
{

    /**
     * Item Name
     * @SWG\Property(format="string")
     * @var string
     */
    public $image;

    /**
     * Item Price
     * @SWG\Property(format="string")
     * @var string
     */
    public $description;

}

/**
 * @SWG\Definition(
 * required={
 * "image"
 * },
 * @SWG\Xml(name="Filters"))
 */

class Filters
{

}

/**
 * @SWG\Definition(
 * required={
 * "id",
 * "slug"
 * },
 * @SWG\Xml(name="Filters"))
 */

class item_categories
{

    /**
     * ID
     * @SWG\Property(format="number")
     * @var number
     */
    public $id;


    /**
     * Item Name
     * @SWG\Property(format="string")
     * @var string
     */
    public $slug;

}


/**
 * @SWG\Definition(
 * required={
 * "first_name",
 * "email",
 * "phone_number",
 * "gender",
 * "password",
 * "country",
 * "day",
 * "month",
 * "year",
 * "account_type"
 * },
 * @SWG\Xml(name="Filters"))
 */
class Profile
{

    /**
     * First Name
     * @SWG\Property(format="string")
     * @var string
     */
    public $first_name;


    /**
     * First Name
     * @SWG\Property(format="string")
     * @var string
     */
    public $last_name;

    /**
     * Email
     * @SWG\Property(format="string")
     * @var string
     */
    public $email;

    /**
     * Password
     * @SWG\Property(format="string")
     * @var string
     */
    public $password;

    /**
     * Status
     * @SWG\Property(format="number")
     * @var number
     */
    public $status;

    /**
     * Offer
     * @SWG\Property(format="number")
     * @var number
     */
    public $amazing_offers;

    /**
     * Emails
     * @SWG\Property(format="number")
     * @var number
     */
    public $occasional_updates;

    /**
     * Account Type
     * @SWG\Property(format="string", default="customer")
     * @var number
     */
    public $account_type;

    /**
     * Date Of Birth
     * @SWG\Property(format="string")
     * @var string
     */
    public $dob;

    /**
     * Gender
     * @SWG\Property(format="number", default="1")
     * @var number
     */
    public $gender;

    /**
     * Country
     * @SWG\Property(format="number", default="1")
     * @var string
     */
    public $country;

    /**
     * Social Type
     * @SWG\Property(format="string", default="self")
     * @var string
     */
    public $socialType;

    /**
     * Social ID
     * @SWG\Property(format="string", default="Id if social type is not self")
     * @var string
     */
    public $socialID;

    /**
     * Picture
     * @SWG\Property(format="string")
     * @var string
     */
    public $picture;

    /**
     * About Me
     * @SWG\Property(format="string")
     * @var string
     */
    public $about_me;


    /**
     * Phone number
     * @SWG\Property(format="string")
     * @var string
     */
    public $phone_number;

    /**
     * Country Code
     * @SWG\Property(format="string")
     * @var string
     */
    public $country_code;

}