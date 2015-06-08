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
        
        function queryItems ($tname, $objs) {
            $kconds = array();
            foreach ($objs as $key => $v) {
                $f = array($v[0] => array(
                    'AttributeValueList' => array(
                        array($v[1] => $v[2])
                    ),
                    'ComparisonOperator' => $v[3]
                ));
                array_push($kconds, $f);
            }
            
            $iterator = array(
                'TableName'     => $tname,
                'KeyConditions' => array_pop($kconds)
            );
            
            $a = $this->ddb->getIterator('Query', $iterator);
            return $a;
        }
    }
?>