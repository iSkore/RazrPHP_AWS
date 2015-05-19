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
            $a = $this->ddb->describeTable(array('TableName' => $table));
            return $a;
        }
        
        function putItem ($tname, $arguments) {
            $args = array(
                'TableName' => $tname,
                'Item' => $arguments
            );
            $a = $this->ddb->putItem($args);
            return $a;
        }
        
        function getItem ($tname, $arguments) {
            $args = array(
                'ConsistentRead' => true,
                'TableName' => $tname,
                'Key' => $arguments
            );
            $a = $this->ddb->getItem($args);
            return $a;
        }
    }
?>