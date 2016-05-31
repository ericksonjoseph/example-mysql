<?php

class Tester {
    use BenchmarkerTrait;

    const DATA_MULTIPLIER = 1000;

    public function __construct(array $opts)
    {
        $this->opts = $opts;
    }

    public function runTest()
    {
        global $PDO;
        $opts = $this->opts;

        // BUILD DATA
        $newData = $this->prepareData();

        echo 'inserting ' . count($newData) . PHP_EOL;

        $U = new Utils($PDO);

        // Decide which method to use
        $method = (isset($opts['b'])) ? 'insert' : 'insertLoop';

        // Decide if we should use a transaction
        $t = isset($opts['t']);

        // Run
        if($U->$method($newData, $t)){
            echo "$method Successful";
        } else {
            echo "$method Failed";
        }
    }

    private function prepareData()
    {
        $dataString = 'a:9:{i:1;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"7I4Pe91tKQA1paBLd8Lm5YmYKcU";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"9mmcrr";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"353011******0000";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32315";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:3;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"2mn2q2";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32335";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:10;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"7f5mz2";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32358";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:11;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"5c5k26";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32359";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:15;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"7yvbkm";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32418";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:96;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"3qp926";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32496";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:147;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"7I4Pe91tKQA1paBLd8Lm5YmYKcU";s:15:"card_expiration";N;s:9:"card_type";N;s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"2n4m72";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"353011******0000";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32071";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:198;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";s:8:"Discover";s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"d4yyh2";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32591";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}i:200;a:18:{s:4:"name";N;s:11:"day_entered";s:19:"2016-05-31 15:04:38";s:13:"date_modified";s:19:"2016-05-31 15:04:38";s:16:"modified_user_id";N;s:10:"created_by";s:1:"0";s:11:"description";N;s:9:"card_name";N;s:11:"card_number";s:27:"ErHJlkd1GvJXOzYrEAIrDZwdv9r";s:15:"card_expiration";N;s:9:"card_type";s:8:"Discover";s:19:"payment_method_type";s:8:"SPREEDLY";s:8:"token_id";s:6:"66wwcm";s:17:"direct_deposit_id";N;s:18:"secure_card_number";s:16:"601111******1117";s:8:"status_c";s:1:"0";s:14:"entitlement_id";s:5:"32594";s:27:"payment_gateway_customer_id";N;s:5:"state";s:8:"verified";}}
            ';

        $data = unserialize($dataString);
        $newData = array();

        for ($i=0; $i < self::DATA_MULTIPLIER; $i++){
            $newData = array_merge($newData, $data);
        }

        return $newData;
    }
}
