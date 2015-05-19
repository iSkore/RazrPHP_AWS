<?php
    
    require ('razrAWS.php');
    use razrPHP as RAZR;
    $razr = new RAZR\rDynamo ();
    
    //        DESCRIBE TABLE
    //$t = $razr->describeTable('razrTable');
    //echo $t;
    //echo $t->getPath('Table/ProvisionedThroughput/ReadCapacityUnits');
    
    //        PUT ITEM
    //$r = array('hashKey' => array('S' => 'Super'), 'rangeKey' => array('S' => 'Coolssss'));
    //$t = $razr->putItem('razrTable', $r);
    //echo $t;
    
    //        GET ITEM
    //$r = array('hashKey' => array('S' => 'Super'), 'rangeKey' => array('S' => 'Coolss'));
    //$t = $razr->getItem('razrTable', $r);
    //echo $t;
    //echo $t->getPath('Item/rangeKey/S');
?>