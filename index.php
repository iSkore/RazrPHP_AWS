<?php
    
    require ('razrAWS.php');
    use razrPHP as RAZR;
    $razr = new RAZR\rDynamo ();
    
    //        DESCRIBE TABLE
    //$t = $razr->describeTable('razrTable');
    //echo $t;
    //echo $t->getPath('Table/ProvisionedThroughput/ReadCapacityUnits');
    
    //        PUT ITEM
    /*$args = array('TableName' => 'razrTable',
        'Item' => array(
            'hashKey'      => array('S' => 'Super'),
            'rangeKey'    => array('S' => 'Coolss')
        )
    );*/
    //$t = $razr->putItem($args);
    
    //        GET ITEM
    /*$args = array(
        'TableName' => 'razrTable',
        'Key' => array(
            'hashKey'      => array('S' => 'Super'),
            'rangeKey'     => array('S' => 'Coolss')
        )
    );*/
    //$t = $razr->getItem($args);
    //echo $t->getPath('Item/rangeKey/S');
    
?>