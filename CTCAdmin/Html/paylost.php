<?php

$mysqli = new mysqli('localhost', 'root', '12345', 'sipsewana') or die(mysqli_error($mysqli)); 

if( isset($_GET['mem'])){

   $mem_id = $_GET['mem'];

   $bid = $_GET['book'];

   $pay = $_GET['pay'];

   $getcdate = "SELECT * FROM lostbook WHERE memberid='$mem_id' AND bookid='$bid' AND price = '$pay'";

   $getresult = mysqli_query($mysqli,$getcdate);

   $getcheck = mysqli_fetch_assoc($getresult);

   

   if(empty($getcheck['paid_date']))
   {

            $currentdate = date('Y-m-d');

            $query = "UPDATE lostbook SET paid_date ='$currentdate' WHERE memberid='$mem_id' AND bookid='$bid' AND price = '$pay'";

            $right = $mysqli->query($query);

                        //SET NOTIFICATION 

                        $ada = date('Y-m-d H:i:s');

                        //Get msg into variable
            
                        $gtmsg= "SELECT msg FROM notification WHERE msgid=11";
            
                        $colmsg = mysqli_query($mysqli,$gtmsg);
            
                        $colmsgcheck = mysqli_fetch_assoc($colmsg);
            
                        $msg = $colmsgcheck['msg'];
            
            
            
                        $not = "INSERT INTO notification(memberid, msg, date) VALUES ('$mem_id','$msg','$ada')";
            
                        $notquery = mysqli_query($mysqli, $not);
            
                        //notification entered.

            if($right==true && $notquery==true)
                {

                header("location:fine.php?true");

                }
                else
                {

                    header("location:fine.php?error");
                   
                }
    }
    else
    {

        header("location:fine.php?paid");

        
    }

}

if( isset($_GET['delmemid'])){

    $delmemid = $_GET['delmemid'];
 
    $delbookid = $_GET['delbook'];

    $delmemp = "DELETE FROM lostbook WHERE memberid ='$delmemid' AND bookid='$delbookid'";

    $delrightp = $mysqli->query($delmemp);

    if($delrightp==true)
    {


        header("location:fine.php?delete");

        }
    else
        {


            header("location:fine.php?error");
           
        }
}
?>