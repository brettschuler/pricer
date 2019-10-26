<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
	 <link rel="stylesheet" href="./css/master.css" type="text/css" />
    <style type="text/css">
        body{ font: 20px sans-serif; text-align: center; 
	}
		.wrapper{ width: 800px; padding: 20px 0px 0px 500px;  }
	</style>
</head>	
<body>
   <div class="page-header">
<br> <h1>Pricer&#8482;.</h1>
<h2> The most complete Medical Pricing System on the internet!</h2>
</div>
<h3>  </h3>
<br><div class="wrapper">
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "config.php";
  
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
//$first_name =  isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$zipcode = mysqli_real_escape_string($link, $_REQUEST['zipcode']);
$occupation = mysqli_real_escape_string($link, $_REQUEST['occupation']);
$diagnosis = mysqli_real_escape_string($link, $_REQUEST['diagnosis']);

 
// Attempt insert query execution
$sql = "insert into CUSTOMER (first_name, last_name, zipcode, occupation, diagnosis) values ('$first_name', '$last_name', '$zipcode', '$occupation', '$diagnosis')";
if(mysqli_query($link, $sql)){
    echo "";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
//mysqli_close($link);

 
// Check connection
//if($mysqli === false){
 //   die("ERROR: Could not connect. " . $mysqli->connect_error);
//}
 
// Attempt select query execution
$sql2 = "SELECT DISTINCT AVG(physician_fee_table.FACILITY_FEE) AS PRICEESTIMATE,HCPCS_TABLE.SHORTDESCRIPTION FROM HCPCS_TABLE INNER JOIN physician_fee_table ON HCPCS_TABLE.HCPC = physician_fee_table.HCPCS WHERE HCPCS_TABLE.SHORTDESCRIPTION  = '$diagnosis' ";
//'Care manag h vst new pt 20 m'";
//GROUP BY HCPCS_TABLE.id,physician_fee_table.FACILITY_FEE,HCPCS_TABLE.SHORTDESCRIPTION  ";
if($result = mysqli_query($link, $sql2)){
    if(mysqli_num_rows($result) > 0){
// if($result->query($sql2)){
    // if($result->num_rows > 0){
        echo "<table>";
            echo "<tr>";
			    //echo "<th>HCPCS_TABLE.id</th>";
                echo "<th>YOUR PRICE ESTIMATE IS:</th>";
                //echo "<th>HCPCS_TABLE.SHORTDESCRIPTION</th>";
            echo "</tr>";
        while($row = $result->fetch_array()){
            echo "<tr>";
				//echo "<td>" . $row['HCPCS_TABLE.id'] . "</td>";
                echo "<td>" . $row['PRICEESTIMATE'] . "</td>";
                //echo "<td>" . $row['HCPCS_TABLE.SHORTDESCRIPTION'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        $result->free();
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
mysqli_close($link);
?>
</br>
</br>
If no price estimate is appearing, we are improving our database.  The price presented is the Average of all Medicare
rates in the United States expressed in USD.
</div></div>
</body>
