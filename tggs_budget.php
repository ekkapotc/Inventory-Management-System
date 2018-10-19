<html>
<head>
<meta charset="UTF-8">

<title>ระบบค้นหาและจัดการครุภัณฑ์ TGGS</title>
</head>
<body>

<!--body background="media/tggs.jpg"-->
<?php
    ini_set('default_charset', 'utf-8');
    $host = "localhost";
    $username = "inventory";
    $password = "tggskmutnb";

    $objConnect = mysql_connect($host,$username,$password);
    //set character set to utf8
    mysql_query("set names 'utf8'");   
    $objDB = mysql_select_db("tggs_inventory");

    $inventoryNo = $_GET['EquipmentID'];

    //select the given row from the respective table
    $strSQL = "SELECT * FROM Budget2 WHERE EquipmentID = '$inventoryNo'";
    $objQuery = mysql_query($strSQL) or die (mysql_error());
    $rowCount = mysql_num_rows($objQuery);

    if($rowCount){
        while($objResult = mysql_fetch_array($objQuery))
        {
            echo'<center>
                    <p> รายการที่ค้นหา </p>
                    <table width="700" border="1">
                        <br>
                        <tr>';
                            echo '<tr bgcolor="#BEBEBE"><th width="200"> <div align="center">Budget <td><div align="center">';
                            echo 'งบเงินรายได้';
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
?>

<br>

<center>
<!-- form -->
    <form action="updateQR.php" method="POST">
        
        <div id="found">
        ผลการสำรวจ : <br>
        <input  name="found" type="radio" value=2 id="yayCheck"  onclick="javascript:hideStatus()"> พบบางส่วน  </input>
        <input  name="found" type="radio" value=1 id="yesCheck"  onclick="javascript:hideStatus()"> สำรวจพบ </input> 
        <input  name="found" type="radio" value=0 id="noCheck"  onclick="javascript:hideStatus()"> ยังไม่พบ  </input>
        </div>

        <br>
        <br>
        
        <div id="status" style="visibility:hidden">
        สภาพของครุภัณฑ์ : <br>
        <input name="status" type="radio" value="ใช้งานได้"> ใช้งานได้ </input>
        <input name="status" type="radio" value="เสื่อมสภาพ"> เสื่อมสภาพ </input>
        </div>

        <br><br>
        
        <div id="user">
        ผู้ใช้งาน/ผู้ดูแลรับผิดชอบ: <input type="text" name="user" value="<?php echo $user;?>">
        </div>

        <br><br>

        <div id="location">
        ตำแหน่งของครุภัณฑ์: <input type="text" name="location" value="<?php echo $location;?>">
        </div>

        <br><br>
        
        <div id="program">
        สาขาวิชา/ส่วนงาน: <!--input type="text" name="program"-->
                        <select name="program">
                            <option value="ASAE"> ASAE </option>
                            <option value="CPE"> CPE </option>
                            <option value="MESD"> MESD </option>
                            <option value="MPEE"> MPE  </option>
                            <option value="CE"> CE  </option>
                            <option value="EPE"> EPE  </option>
                            <option value="SSE"> SSE  </option>
                            <option value="OD"> ส่วนกลาง </option>
                        </select>
        </div>

        <br><br>

        <div id="department">
        ภาควิชา: <!--input type="text" name="department"-->
                <select name="department">
                        <option value="ESSE"> ESSE </option>
                        <option value="MEPE"> MEPE </option>
                        <option value="TGGS"> TGGS </option>
                </select>
        </div>

        <br><br>

        <div id="note">
        หมายเหตุ: <textarea name="note"  cols="40" rows="10"><?php echo $note;?></textarea>
        <!--input type="text" name="note" value="<?php echo $note;?>"-->
        </div>
        
        <br><br>

        <div id="lastseen">
        พบครั้งสุดท้าย: <input type="text" name="lastseen" value="<?php echo date('d F Y');?>">
        </div>
        
        <br><br>

        <!-- hidden variables to pass to update.php  -->
        <input type="hidden" name="equipmentid" value= 
        <?php
            echo $inventoryNo;
        ?>
        >
        </input> 
        
        <input type="hidden" name="catagory" value= 
        <?php
            echo 'Budget2';
        ?>
        >
        </input>
            
        <input type="submit" name="update" value="อัพเดตสถานะการสำรวจพบ" />
    </form>
</center>
<br>

<?php
    }else
    {
        echo '<center>
                <h1>
                    <b> 
                        ไม่เจอครุภัณฑ์ดังกล่าว 
                    </b>
                </h1>
            </center>';
    }//end if
    mysql_close($objConnect);
?>

<script type="text/javascript">
   function hideStatus(){
        if(document.getElementById('noCheck').checked){
            document.getElementById('status').style.visibility = 'hidden';
        }else if(document.getElementById('yesCheck').checked){
            document.getElementById('status').style.visibility = 'visible';
        }else if(document.getElementById('yayCheck').checked){
            document.getElementById('status').style.visibility = 'visible';
        }
    }
</script>

</body>
</html>