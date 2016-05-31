<?php

class Utils {

    public function __construct($pdo)
    {
        $this->pdo_obj = $pdo;
    }

    /**
     * Inserts rows by looping the execute command optionally using a transaction
     *
     * @param string $strInsert
     * @param array  $variables
     *
     * @return bool - TRUE if all records inserted successfully
     *
     * @throws \InvalidArgumentException
     */
    public function insertLoop(array $variables = [], $transaction = false)
    {
        $strInsert = 'INSERT INTO payment_methods (name,day_entered,date_modified,modified_user_id,created_by,description,card_name,card_number,card_expiration,card_type,payment_method_type,token_id,direct_deposit_id,secure_card_number,status_c,entitlement_id,payment_gateway_customer_id,state) VALUES (:name,:day_entered,:date_modified,:modified_user_id,:created_by,:description,:card_name,:card_number,:card_expiration,:card_type,:payment_method_type,:token_id,:direct_deposit_id,:secure_card_number,:status_c,:entitlement_id,:payment_gateway_customer_id,:state);';

        $totalRows = -1;
        $success = true;

        try {
            $ins = $this->pdo_obj->prepare($strInsert);

            if ($transaction)
                $this->pdo_obj->beginTransaction();

            foreach ($variables as $i => $variableSet) {
                $ins->execute($variableSet);
            }

            if ($transaction)
                $this->pdo_obj->commit();

        } catch (PDOException $pdoException) {

            $this->pdo_obj->rollBack();

            echo 'ERROR:' . $pdoException->getMessage() . PHP_EOL;
            echo 'ERROR:' . $pdoException->getTraceAsString() . PHP_EOL;

            $success = false;
        }

        return $success;
    }

    /* A custom function that automatically constructs a multi insert statement.
     * 
     * @param array $data - An "array of arrays" containing our row data.
     * @param boolean $transaction - use a transaction?
     * @return boolean TRUE on success. FALSE on failure.
     */
    function insert(array $data, $transaction = false){

        //Will contain SQL snippets.
        $rowsSQL = array();

        //Will contain the values that we need to bind.
        $toBind = array();

        //Get a list of column names to use in the SQL statement.
        $columnNames = array_keys(reset($data));

        //Loop through our $data array.
        foreach($data as $arrayIndex => $row){
            $params = array();
            foreach($row as $columnName => $columnValue){
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue; 
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }

        //Construct our SQL statement
        $sql = "INSERT INTO `payment_methods` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);

        //Prepare our PDO statement.
        $pdoStatement = $this->pdo_obj->prepare($sql);

        //Bind our values.
        foreach($toBind as $param => $val){
            $pdoStatement->bindValue($param, $val);
        }

        //Execute our statement (i.e. insert the data).
        if ($transaction)
            $this->pdo_obj->beginTransaction();

        $return = $pdoStatement->execute();

        if ($transaction)
            $this->pdo_obj->commit();

        return $return;
    }
}
