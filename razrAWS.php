<?php namespace razrPHP;
    
    require 'aws/aws-autoloader.php';
    date_default_timezone_set ('America/New_York');
    use Aws\Credentials\CredentialProvider;
    use Aws\DynamoDb\DynamoDbClient;
    use Aws\Ec2\Ec2Client;
    
    class rAWS {
        public $ddb;
        public $ec2;
        
        function __construct () {
            $provider = CredentialProvider::defaultProvider();
            $this->ddb = new DynamoDbClient([
                'region'      => 'us-east-1',
                'version'     => 'latest',
                'credentials' => $provider
            ]);
            $this->ec2 = new Ec2Client([
                'region'      => 'us-east-1',
                'version'     => 'latest',
                'credentials' => $provider
            ]);
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
        
        function takeImage ($instID, $amiName) {
            $datea = date_format(date_create(), 'm-d-Y H:i:s');
            $datex = date_format(date_create(), 'm_d_Y_H_i_s');
            $a = $this->ec2->createImage([
                'BlockDeviceMappings' => [
                    [
                        'DeviceName' => '/dev/sda1',
                        'Ebs' => [
                            'DeleteOnTermination' => true,
                            'Encrypted' => false,
                            'VolumeSize' => 10,
                            'VolumeType' => 'standard',
                        ]
                    ]
                ],
                'Description' => 'Image of server '.$instID.' taken on '.$datea,
                'InstanceId' => $instID,
                'Name' => $datex.'_Image_'.$amiName,
                'NoReboot' => false
            ]);
            return $a;
        }
    }
?>