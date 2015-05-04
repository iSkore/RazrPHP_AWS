<?php namespace razrPHP;
    
    require 'aws/aws-autoloader.php';
    
    use Aws\Common\Aws;
    use Aws\DynamoDb\DynamoDbClient;
    
    class rDynamo {
        public $ddb;
        
        function __construct () {
            $this->ddb = Aws::factory('config.php')->get('dynamodb');
        }
        
        function describeTable ($table) {
            $y = $this->ddb->describeTable(array( 'TableName' => $table));
            return $y;
        }
    }
?>


<?php
/*
$resultf = $dynamoDb->getItem(array(
                'TableName' => 'cerenityDeveloperTable',
                'Key'       => array(
                    'cerenityDefault'   => array('S' => 'CERE'),
                    'cerenityUser' => array('S' => $input3a)
                 )
            ));
            if (empty($resultf['Item']['cerenityUser']['S'])) {
                $resulta = $dynamoDb->putItem(array(
                    'TableName' => 'cerenityDeveloperTable',
                    'Item' => array(
                        'cerenityDefault' => array('S' => 'CERE'),
                        'cerenityUser' => array('S' => $input3a),
                        'cerenityFname' => array('S' => $input1a),
                        'cerenityLname' => array('S' => $input2a)
                    )
                ));
                if (isset ($resulta)) {
                    echo 2;
                    exit;
                } else {
                    echo 3;
                    exit;
                }
            } else {
                echo 0;
                exit;
            }
            */

?>