<?php
    
    require ('razrAWS.php');
    use razrPHP as RAZR;
    $razr = new RAZR\rDynamo ();
    
    //        CREATE TABLE
    //$table = 'razrTable2';
    //$hK = array('id', 'S', 'HASH');
    //$rK = array('name', 'S', 'RANGE');
    //$tput = array(1, 1);
    //$t = $razr->razrTable($table, $hK, $rK, $tput);
    //echo $t;
    
    //        DESCRIBE TABLE
    //$t = $razr->describeTable('razrTable');
    //echo $t;
    //echo $t->getPath('Table/ProvisionedThroughput/ReadCapacityUnits');
    
    //        PUT ITEM
    //$r = array('hashKey' => array('S' => 'Super'), 'rangeKey' => array('S' => 'Coolssss'));
    //$t = $razr->putItem('razrTable', $r);
    //echo $t;
    
    //        GET ITEM
    $r = array('hashKey' => array('S' => 'Super'), 'rangeKey' => array('S' => 'Coolss'));
    $t = $razr->getItem('razrTable', $r);
    echo $t;
    //echo $t->getPath('Item/rangeKey/S');
    
    //        QUERY ITEMS
    //$conditions = array();
    //$conditions['hash'] = 'hashKey';
    //$conditions['type'] = 'S';
    //$conditions['value']= 'Super';
    //$conditions['oper'] = 'EQ';
    //$t = $razr->queryItems('razrTable', $conditions);
    //foreach ($t as $item) {
    //    echo $item['rangeKey']['S']."\n";
    //}
?>