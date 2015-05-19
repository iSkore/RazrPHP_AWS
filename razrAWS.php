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
        
        function putItem ($arguments) {
            $a = $this->ddb->putItem($arguments);
            return $a;
        }
        
        function getItem ($arguments) {
            array_push($arguments, array('ConsistentRead' => true));
            $a = $this->ddb->getItem($arguments);
            return $a;
        }
    }
?>