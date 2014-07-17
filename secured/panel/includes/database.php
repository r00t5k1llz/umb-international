<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Wikishore
 * Date: 9/2/13
 * Time: 3:41 AM
 * To change this template use File | Settings | File Templates.
 */

$dbConn = mysql_connect('localhost', 'jeanlinux', 'j5an1inux');
$selectDb = mysql_select_db('bank', $dbConn);
if(!$dbConn || !$selectDb){
    die("Can't connect to database: " . mysql_error());
}