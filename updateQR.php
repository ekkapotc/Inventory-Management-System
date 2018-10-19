<html>
<head>
<meta charset="UTF-8">

<title>ระบบค้นหาและจัดการครุภัณฑ์ TGGS </title>
</head>
<body>
<!--body background="media/tggs.jpg"-->

<?php

    ini_set('default_charset', 'utf-8');
    //PHP variables passed from the previous page
    $catagory = $_POST['catagory'];
    $equipmentid = $_POST['equipmentid'];
    $found = $_POST['found'];
    
    //check if the status radio boxes are visible
    if(isset($_POST['status'])){
        $status = $_POST['status'];
    }else{
        $status = "";
    }

    $user = $_POST['user'];
    $location = $_POST['location'];
    $program = $_POST['program'];
    $department = $_POST['department'];
    $note = $_POST['note'];
    $lastseen = $_POST['lastseen'];

    //database info
    $host = "localhost";
    $username = "inventory";
    $password = "tggskmutnb";

    //connect to the database server
    $objConnect = mysql_connect($host,$username,$password);
    //set character set to utf8
    mysql_query("set names 'utf8'");   
    $objDB = mysql_select_db("tggs_inventory");

    //update the given row in the respective table
    $strSQL = "UPDATE $catagory SET Found='$found', Status='$status', User='$user', Location='$location', Program='$program', Department='$department', Note='$note' , LastSeen='$lastseen' WHERE EquipmentID='$equipmentid'";
    $objQuery = mysql_query($strSQL) or die (mysql_error());

    //select the given row from the respective table
    $strSQL = "SELECT * FROM $catagory WHERE EquipmentID = '$equipmentid'";
    $objQuery = mysql_query($strSQL) or die (mysql_error());
    $rowCount = mysql_num_rows($objQuery);

    if($rowCount)
    {
        while($objResult = mysql_fetch_array($objQuery))
        {  
            echo'<center>
                    <p> รายการที่ค้นหา </p>
                    <table width="700" border="1">
                        <br>
                        <tr>';
                            echo '<tr bgcolor="#BEBEBE"><th width="200"> <div align="center">Budget <td><div align="center">';
                            if($catagory==="Budget"){
                                echo 'งบประมาณแผ่นดิน';
                            }else if($catagory==="Budget2"){
                                echo 'งบเงินรายได้';
                            }else if($catagory==="Budget3"){
                                echo 'งบเก่า';
                            }else if($catagory==="Budget4"){
                                echo 'งบสาขา MPE';
                            }
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="100"> <div align="center">Equipment ID <td><div align="center">';
                            echo $objResult["EquipmentID"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#BEBEBE"><th width="200"> <div align="center">Equipment Description <td><div align="center">';
                            echo $objResult["Equipment Description"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="97"> <div align="center">Check-In Date <td><div align="center">';
                            echo $objResult["Check-In Date"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#BEBEBE"><th width="90"> <div align="center">User <td><div align="center">';
                            echo $objResult["User"];
                            $user = $objResult["User"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="70"> <div align="center">Location <td><div align="center">';
                            echo $objResult["Location"];
                            $location = $objResult["Location"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#BEBEBE"><th width="50"> <div align="center">Program <td><div align="center">';
                            echo $objResult["Program"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="50"> <div align="center">Department <td><div align="center">';
                            echo $objResult["Department"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#BEBEBE"><th width="70"> <div align="center">Found <td><div align="center">';
                            if(!$objResult["Found"]){
                                echo 'ไม่พบ';
                            }else if($objResult["Found"]==1){
                                echo 'พบ';
                            }else if($objResult["Found"]==2){
                                echo 'พบบางส่วน';
                            }
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="70"> <div align="center">Status <td><div align="center">';
                            echo $objResult["Status"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#BEBEBE"><th width="70"> <div align="center">Note <td><div align="center">';
                            echo $objResult["Note"];
                            $note = $objResult["Note"];
                            echo '</td></tr></div></th>';

                            echo '<tr bgcolor="#778899"><th width="70"> <div align="center">Last Seen <td><div align="center">';
                            echo $objResult["LastSeen"];
                            $lastseen = $objResult["LastSeen"];
                            echo '</td></tr></div></th>';

                            echo '
                        </br>
                        </tr>
                    </table>
                </center>';
        }//end while
    }//end if

    //close the connection
    mysql_close($objConnect);
?>

<br>
<br>

<center>
    <button onclick="goBack(-1)">กลับไปหน้าเดิม</button>
</center>

<script type="text/javascript">
    function goBack(nsteps) {
        window.history.go(nsteps);
    }
</script>
</body>
</html>