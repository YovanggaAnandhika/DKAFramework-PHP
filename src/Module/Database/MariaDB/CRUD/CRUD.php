<?php

namespace yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD;

use PDO;
use PDOException;
use PDOStatement;
use yovanggaanandhika\dkaframework\Interface\Database\MariaDB\CRUD as CRUDInterface;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Create;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Read;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Update;
use function _\get;

class CRUD implements CRUDInterface {

    private static mixed $returnVar;
    /**
     * @return mixed
     */
    private function getReturnVar(): mixed
    {
        return self::$returnVar;
    }
    /**
     * @param mixed $returnVar
     */
    private function setReturnVar(mixed $returnVar): void
    {
        self::$returnVar = $returnVar;
    }

    private static PDO $Connector;

    private function getConnector(): PDO
    {
        return self::$Connector;
    }
    /**
     * @param mixed $Connector
     */
    private function setConnector(PDO $Connector): void
    {
        self::$Connector = $Connector;
    }

    public function __construct(PDO $Connector)
    {
        $this->setConnector($Connector);
    }

    /** **
     * @param string $table_name
     * @param Create\Options $options
     * @return array|string
     */
    public function Create(string $table_name, Create\Options $options) : array | string {
        /**
         * @var array $column
         * @var array $columnParams
         * Column Table Insert Declare
         */
        $column = [];
        $columnParams = [];
        /**
         * Default Callback
         */
        self::setReturnVar(array(
            'status' => false,
            'code' => 500,
            'msg' => 'not initialization'
        ));
        /**
         * get Connector DB Maria
         */
        $connector = $this->getConnector();
        /**
         * @var array $columnField
         * Looping Column data and params
         */
        foreach (array_keys($options::getDataList()) as $columnField){
            $column[] = "`$columnField`";
            $columnParams[] = ":$columnField";
        }
        /**
         * @var string $columnToString
         * @var string $params
         * Convert array to String with comma (,);
         */
        $columnToString = implode(",",$column);
        $params = implode(",",$columnParams);
        /** @lang $SQLScript */
        $SQLScript = /** @lang text */ "INSERT INTO `$table_name` ($columnToString) VALUES ($params);";
        /** * @var PDOStatement $statment
         * Prepare Connector For SQLScript
         */
        $statement = $connector->prepare($SQLScript);
        /** @var array $columnFieldParams
         * Prevent for SQL Injection and Inject array To SQLScript with bind params
         */
        foreach (array_keys($options::getDataList()) as $columnFieldParams){
            $statement->bindParam(":$columnFieldParams",$options::getDataList()[$columnFieldParams],PDO::PARAM_STR);
        }
        try {
            /*** Execute script */
            $execute = $statement->execute();
            /*** Checking If Execute Successfully */
            if ($execute){
                self::setReturnVar(array(
                    'status' => true,
                    'code' => 200,
                    'msg' => 'successfully to insert data',
                    'data' => $options::getDataList(),
                    'metadata' => array(
                        'SQLRaw' => $statement->queryString
                    )
                ));
            }else{
                self::setReturnVar(array(
                    'status' => false,
                    'code' => 404,
                    'msg' => 'failed to insert data'
                ));
            }
        }catch (PDOException $e){
            self::setReturnVar(array(
                'status' => false,
                'code' => 500,
                'msg' => 'error Execution Create Data',
                "error" => array(
                    "code" => $e->errorInfo[1],
                    'msg' => $e->errorInfo[2]
                ),
                'metadata' => array(
                    'SQLRaw' => $statement->queryString,
                )
            ));
        }
        /** Return Variable */
        return ($options::isJsonFormat() ? json_encode(self::getReturnVar(), JSON_PRETTY_PRINT) : self::getReturnVar());
    }
    /**
     * @fun Read
     * @param $table_name string
     * @param Read\Options $options
     * @return array | string
     */
    public function Read(string $table_name, Read\Options $options = new Read\Options()) : array | string
    {
        /**
         * @var string $ExtendedScript
         */
        $search = [];
        $ExtendedScript = "";
        /**
         * Default Callback
         */
        self::setReturnVar(array(
            'status' => false,
            'code' => 500,
            'msg' => 'not initialization'
        ));
        /**
         * get Connector DB Maria
         */
        $connector = $this->getConnector();

        //##############################
        $dataSearchArray = $options::getDataSearch();
        foreach (array_keys($options::getDataSearch()) as $SearchItem){
            if (gettype($SearchItem) !== "integer"){
                $CheckType = (gettype($dataSearchArray[$SearchItem]) === "integer") ? $dataSearchArray[$SearchItem] : "'".$dataSearchArray[$SearchItem]."'";
                $search[] = "$SearchItem=$CheckType";
            }else{
                $search[] = $dataSearchArray[$SearchItem];
            }
        }

        if (count($search) > 0){
            $SearchToString = implode(" ", $search);
            $ExtendedScript .= " WHERE $SearchToString";
        }
        //##############################
        $Limit = (!is_null($options::getGetLimit()) ? " LIMIT ".$options::getGetLimit() : "");
        $ExtendedScript .= $Limit;
        //#############################

        $SQLScript = /** @lang text */ "SELECT * FROM `$table_name`$ExtendedScript;";
        $statement = $connector->prepare($SQLScript);

        try {
            $statement->execute();
            $fetch = $statement->fetchAll(PDO::FETCH_ASSOC);
            $errorInfo = $statement->errorInfo();
            $rowCount = $statement->rowCount();

            if (is_null($errorInfo[1])){
                if ($rowCount > 0){
                    /** set Response Return Variable **/
                    self::setReturnVar(array(
                        'status' => true,
                        'code' => 200,
                        'msg' => 'successfully to read data',
                        "data" => $fetch,
                        "metadata" => array(
                            "SQLRaw" => $statement->queryString,
                            "size" => $rowCount
                        )
                    ));
                    /** End set Response Return Variable **/
                }else{
                    /** set Response Return Variable **/
                    self::setReturnVar(array(
                        'status' => false,
                        'code' => 404,
                        'msg' => 'successfully, but not found data',
                        "error" => array(
                            "code" => $errorInfo[1],
                            'msg' => $errorInfo[2]
                        )
                    ));
                    /** End set Response Return Variable **/
                }
            }else{
                /** set Response Return Variable **/
                self::setReturnVar(array(
                    'status' => false,
                    'code' => 500,
                    'msg' => 'fatal, error detected',
                    "error" => array(
                        "code" => $errorInfo[1],
                        'msg' => $errorInfo[2]
                    )
                ));
                /** End set Response Return Variable **/
            }
        }catch (PDOException $e){
            self::setReturnVar(array(
                'status' => false,
                'code' => 500,
                'msg' => 'error Execution Read Data',
                "error" => array(
                    "code" => $e->errorInfo[1],
                    'msg' => $e->errorInfo[2]
                ),
                'metadata' => array(
                    'SQLRaw' => $statement->queryString,
                )
            ));
        }
        /** Return Variable */
        return ($options::isJsonFormat() ? json_encode(self::getReturnVar(), JSON_PRETTY_PRINT) : self::getReturnVar());
    }

    public function Update(string $table_name, Update\Options $options): string | array
    {
        /**
         * @var array $column
         * @var string $ExtendedScript
         * Column Table Insert Declare
         */
        $column = [];
        $search = [];
        $ExtendedScript = "";
        /**
         * Default Callback
         */
        self::setReturnVar(array(
            'status' => false,
            'code' => 500,
            'msg' => 'not initialization'
        ));
        /**
         * get Connector DB Maria
         */
        $connector = $this->getConnector();

        foreach (array_keys($options::getDataList()) as $columnField){
            $column[] = "`$columnField`=:k$columnField";
        }

        $columnToString = implode(",",$column);

        $dataSearchArray = $options::getDataSearch();
        foreach (array_keys($options::getDataSearch()) as $SearchItem){
            if (gettype($SearchItem) !== "integer"){
                $CheckType = (gettype($dataSearchArray[$SearchItem]) === "integer") ? $dataSearchArray[$SearchItem] : "'".$dataSearchArray[$SearchItem]."'";
                $search[] = "$SearchItem=$CheckType";
            }else{
                $search[] = $dataSearchArray[$SearchItem];
            }
        }

        if (count($search) > 0){
            $SearchToString = implode(" ", $search);
            $ExtendedScript .= " WHERE $SearchToString";
        }

        /** @lang $SQLScript */
        $SQLScript = /** @lang text */ "UPDATE `$table_name` SET $columnToString$ExtendedScript;";

        /** * @var PDOStatement $statment
         * Prepare Connector For SQLScript
         */

        $statement = $connector->prepare($SQLScript);

        /** @var array $columnFieldParams
         * Prevent for SQL Injection and Inject array To SQLScript with bind params
         */
        foreach (array_keys($options::getDataList()) as $columnFieldParams){
            $statement->bindParam(":k$columnFieldParams",$options::getDataList()[$columnFieldParams]);
        }

        try {
            /*** Execute script */
            $execute = $statement->execute();
            /*** Checking If Execute Successfully */
            $errorInfo = $statement->errorInfo();
            $rowCount = $statement->rowCount();
            if ($rowCount > 0){
                self::setReturnVar(array(
                    'status' => true,
                    'code' => 200,
                    'msg' => 'successfully to update Data',
                    'data' => $options::getDataList(),
                    'metadata' => array(
                        'SQLRaw' => $statement->queryString,
                        'size' => $rowCount
                    )
                ));
            }else{
                self::setReturnVar(array(
                    'status' => false,
                    'code' => 404,
                    'msg' => 'successfully. but not data update',
                    'data' => $options::getDataList(),
                    'metadata' => array(
                        'SQLRaw' => $statement->queryString,
                        'size' => $rowCount
                    )
                ));
            }
        }catch (PDOException $e){
            self::setReturnVar(array(
                'status' => false,
                'code' => 500,
                'msg' => 'error Execution Updata Data',
                "error" => array(
                    "code" => $e->errorInfo[1],
                    'msg' => $e->errorInfo[2]
                ),
                'metadata' => array(
                    'SQLRaw' => $statement->queryString,
                )
            ));
        }

        /** Return Variable */
        return ($options::isJsonFormat() ? json_encode(self::getReturnVar(), JSON_PRETTY_PRINT) : self::getReturnVar());
    }

    public function Delete(string $table_name, Delete\Options $options) : string | array {

        /**
         * @var array $column
         * @var string $ExtendedScript
         * Column Table Insert Declare
         */
        $search = [];
        $ExtendedScript = "";
        /**
         * Default Callback
         */
        self::setReturnVar(array(
            'status' => false,
            'code' => 500,
            'msg' => 'not initialization'
        ));
        /**
         * get Connector DB Maria
         */
        $connector = $this->getConnector();

        $dataSearchArray = $options::getDataSearch();
        foreach (array_keys($options::getDataSearch()) as $SearchItem){
            if (gettype($SearchItem) !== "integer"){
                $CheckType = (gettype($dataSearchArray[$SearchItem]) === "integer") ? $dataSearchArray[$SearchItem] : "'".$dataSearchArray[$SearchItem]."'";
                $search[] = "$SearchItem=$CheckType";
            }else{
                $search[] = $dataSearchArray[$SearchItem];
            }
        }

        if (count($search) > 0){
            $SearchToString = implode(" ", $search);
            $ExtendedScript .= " WHERE $SearchToString";
        }

        /** @lang $SQLScript */
        $SQLScript = /** @lang text */ "DELETE FROM `$table_name`$ExtendedScript;";
        /** * @var PDOStatement $statment
         * Prepare Connector For SQLScript
         */

        $statement = $connector->prepare($SQLScript);

        try {
            /*** Execute script */
            $statement->execute();
            /*** End Execute script */
            $errorInfo = $statement->errorInfo();
            $rowCount = $statement->rowCount();
            /*** Checking If Execute Successfully */
            if ($rowCount > 0) {
                /** set Response Return Variable **/
                self::setReturnVar(array(
                    'status' => true,
                    'code' => 200,
                    'msg' => 'successfully to delete data',
                    "metadata" => array(
                        "SQLRaw" => $statement->queryString,
                        "size" => $rowCount
                    )
                ));
                /** End set Response Return Variable **/
            }else{
                /** set Response Return Variable **/
                self::setReturnVar(array(
                    'status' => false,
                    'code' => 404,
                    'msg' => 'successfully. but data not exist for delete',
                    "metadata" => array(
                        "SQLRaw" => $statement->queryString,
                        "size" => $rowCount
                    )
                ));
                /** End set Response Return Variable **/
            }
        }catch (PDOException $e){
            self::setReturnVar(array(
                'status' => false,
                'code' => 500,
                'msg' => 'error Execution Delete Data',
                "error" => array(
                    "code" => $e->errorInfo[1],
                    'msg' => $e->errorInfo[2]
                ),
                'metadata' => array(
                    'SQLRaw' => $statement->queryString,
                )
            ));
        }


        return ($options::isJsonFormat() ? json_encode(self::getReturnVar(), JSON_PRETTY_PRINT) : self::getReturnVar());
    }
}
