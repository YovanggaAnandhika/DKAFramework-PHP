<?php
namespace dkaframework\core\Module\Database\MariaDB\CRUD\Delete;

class Options
{

    private static bool $getJsonFormat = false;
    private static array $dataSearch = [];

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
    public static function setJsonFormat(bool $getJsonFormat): void
    {
        self::$getJsonFormat = $getJsonFormat;
    }

    /**
     * @return array
     */
    public static function getDataSearch(): array
    {
        return self::$dataSearch;
    }

    /**
     * @param array $dataSearch
     */
    public static function setDataSearch(array $dataSearch): void
    {
        self::$dataSearch = $dataSearch;
    }

    public function jsonFormat(bool $jsonFormat) : Options {
        self::setJsonFormat($jsonFormat);
        return $this;
    }

    public function addSearch(array $dataSearch): Options
    {
        self::setDataSearch($dataSearch);
        return $this;
    }
}
