<?php
namespace yovanggaanandhika\dkaframework\Module\Database\CRUD\Read;

class OptionsRead {

    private static int | null $getLimit = null;
    private static bool $getJsonFormat = false;

    /**
     * @return int | null
     */
    public static function getGetLimit(): int | null
    {
        return self::$getLimit;
    }

    /**
     * @return bool
     */
    public static function isJsonFormat(): bool
    {
        return self::$getJsonFormat;
    }

    /**
     * @param bool $getJsonFormat
     */
    private static function setJsonFormat(bool $getJsonFormat): void
    {
        self::$getJsonFormat = $getJsonFormat;
    }

    /**
     * @param int $getLimit
     */
    private static function setGetLimit(int $getLimit): void
    {
        self::$getLimit = $getLimit;
    }


    public function limit(int $limit) : OptionsRead {
        self::setGetLimit($limit);
        return $this;
    }

    public function jsonFormat(bool $jsonFormat){
        self::setJsonFormat($jsonFormat);
        return $this;
    }


}