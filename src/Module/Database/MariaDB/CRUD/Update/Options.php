<?php

namespace dkaframework\core\Module\Database\MariaDB\CRUD\Update;

class Options {

    private static bool $getJsonFormat = false;

    private static array $DataList = [];

    private static array $dataSearch = [];

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
     * @param bool $getJsonFormat
     */
    private static function setJsonFormat(bool $getJsonFormat): void
    {
        self::$getJsonFormat = $getJsonFormat;
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

    public function jsonFormat(bool $jsonFormat) : Options {
        self::setJsonFormat($jsonFormat);
        return $this;
    }

    public function setData(array $dataList) : Options {
        self::setDataList($dataList);
        return $this;
    }

    public function addSearch(array $dataSearch) : Options {
        self::addDataSearch($dataSearch);
        return $this;
    }


}