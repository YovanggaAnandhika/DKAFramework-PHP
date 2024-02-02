<?php
namespace dkaframework\core\Module\Database\MariaDB\CRUD\Read;

class Options {

    private static int | null $getLimit = null;
    private static bool $getJsonFormat = false;
    private static array $dataSearch = [];


    /**
     * @return array
     */
    public static function getDataSearch(): array
    {
        return self::$dataSearch;
    }

    /**
     * @param array $item
     * @return void
     */
    public static function addDataSearch(array $item): void
    {
        self::$dataSearch = $item;
    }

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


    public function limit(int $limit) : Options {
        self::setGetLimit($limit);
        return $this;
    }

    public function jsonFormat(bool $jsonFormat){
        self::setJsonFormat($jsonFormat);
        return $this;
    }

    public function addSearch(array $dataSearch) : Options {
        self::addDataSearch($dataSearch);
        return $this;
    }


}