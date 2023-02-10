<html>
<head>
	<title>Insert Data</title>
</head>
<body>
<?php
extract ($_POST);
extract ($_GET);
include "koneksi.php";
$data="SELECT * FROM menu WHERE id='$id'";
$sql=mysql_query($data);
$array=mysql_fetch_array($sql);
?>

	<div align="center"><strong>EDIT DATA</strong></div>
	<form action="proseseditdata.php" method="post">		
		<table width="376" border="0" align="center" bgcolor="#CCCCCC">
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input name="id" type="text" id="id" value="<?php echo "$array[0]";?>" /></td>
              </tr>
              <tr>
                <td width="88">judul menu </td>
                <td width="10">:</td>
                <td width="264"><input name="judulmenu" type="text" id="judulmenu" 							                 value="<?php echo 	"$array[1]";?>" /></td>
              </tr>
              <tr>
                <td valign="top">isi menu </td>
                <td valign="top">:</td>
                <td><textarea cols="30" id="isimenu" name="isimenu" 										                  rows="5"><?php echo "$array[2]";?></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" name="edit" value="update" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
	</form>
	<br />
	</body>
	</html>