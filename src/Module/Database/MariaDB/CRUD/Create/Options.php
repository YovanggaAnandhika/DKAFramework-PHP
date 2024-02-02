<?php
namespace dkaframework\core\Module\Database\MariaDB\CRUD\Create;

class Options {

    private static bool $getJsonFormat = false;

    private static array $DataList = [];
    /**
     * @return bool
     */
    public static function isJsonFormat(): bool
    {
        return self::$getJsonFormat;
    }

    /**
     * @return array
     */
    public static function getDataList(): array
    {
        return self::$DataList;
    }

    /**
     * @param array $DataList
     */
    public static function setDataList(array $DataList): void
    {
        self::$DataList = $DataList;
    }

    /**
     * @param bool $getJsonFormat
     */
    private static function setJsonFormat(bool $getJsonFormat): void
    {
        self::$getJsonFormat = $getJsonFormat;
    }

    public function jsonFormat(bool $jsonFormat){
        self::setJsonFormat($jsonFormat);
        return $this;
    }

    public function setData(array $list){
        self::setDataList($list);
        return $this;
    }



}