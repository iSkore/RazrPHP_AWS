<?php namespace razrPHP;
    
    require 'aws/aws-autoloader.php';
    
    use Aws\Common\Aws;
    use Aws\DynamoDb\DynamoDbClient;
    
    class rDynamo {
        public $ddb;
        
        function __construct () {
            $this->ddb = Aws::factory('config.php')->get('dynamodb');
        }
        
        function razrTable ($table, $hk, $rk, $tput) {
            $creation=array('TableName'=>$table,'AttributeDefinitions'=>array(array('AttributeName'=>$hk[0],'AttributeType'=>$hk[1]),array('AttributeName'=>$rk[0],'AttributeType'=>$rk[1])),'KeySchema'=>array(array('AttributeName' => $hk[0],'KeyType'=>$hk[2]),array('AttributeName'=>$rk[0],'KeyType'=>$rk[2])),'ProvisionedThroughput'=>array('ReadCapacityUnits'=>$tput[0],'WriteCapacityUnits'=>$tput[1]));
            $a = $this->ddb->createTable($creation);
            return $a;
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
        
        function queryItems ($tname, $objs) {
            $f = array($objs['hash'] => array(
                'AttributeValueList' => array(
                    array($objs['type'] => $objs['value'])
                ),
                'ComparisonOperator' => $objs['oper']
            ));
            
            $iterator = array(
                'TableName'     => $tname,
                'KeyConditions' => $f
            );
            
            $a = $this->ddb->getIterator('Query', $iterator);
            return $a;
        }
        
        
    }
?>