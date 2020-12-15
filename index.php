<?php
require("model/dbconnModel.php");
$con = new dbconnModel;
$con = $con->db;
$db_obj = new class{};
if($result = $con->query("SHOW tables")) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
            if($res = $con->query("DESCRIBE ".$row[0])) {
                $db_obj->{$row[0]} = [];
                while ($row_colname = $res->fetch_row()) {
                        array_push($db_obj->{$row[0]},$row_colname[0]);

                }
            }
    }
    /* free result set */
    $result->close();
    echo json_encode($db_obj);
    
}
else echo "cannot fetch tables";
?>