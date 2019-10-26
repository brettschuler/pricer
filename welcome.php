<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
	 <link rel="stylesheet" href="./css/master.css" type="text/css" />
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
	}
	</style>
	
	<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
		.form-group{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
		border-radius: 4px;
    }
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
		border-radius: 4px;
	}
	.search-box2{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
		border-radius: 4px;
    }
	.search-box3{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
		border-radius: 4px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
		border-radius: 4px;
    }
	.search-box2 input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
		border-radius: 4px;
    }
	.search-box3 input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
		border-radius: 4px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
		border-radius: 4px;
    }
	.search-box2 input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
		border-radius: 4px;
    }
	.search-box3 input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
		border-radius: 4px;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
		background: #ffffff;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box2 input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search2.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box2").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box3 input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search3.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box3").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
	
</head>
<body>
   <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.<br> Welcome to Pricer&#8482;.</h1>
<h2> The most complete Medical Pricing System on the internet!</h2>
</div>
<h3> Please enter a few details below, and we will provide you a price for your medical diagnosis. </h3>
<br>
<br>
   
		<form method="post" action="result.php" >
		<div class="form-group">
		  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name..."/>
		</div>
		<br/>
		<br/>
		<div class="form-group">
		  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name..."  />
		</div>
		<br/>
		<br/>
	    <div class="search-box">
        <input type="text" autocomplete="off" id="zipcode" name="zipcode" placeholder="Enter your zip code..." class="form-control" />
        <div class="result"></div>
		</div>
		<br/>
		<br/>
		<div class="search-box2">
        <input type="text" autocomplete="off" id="occupation" name="occupation" placeholder="Enter your occupation..." class="form-control" />
        <div class="result"></div>
		</div>
		<br/>
		<br/>
		<div class="search-box3">
        <input type="text" autocomplete="off" id="diagnosis" name="diagnosis" placeholder="Enter your diagnosis..." class="form-control" />
        <div class="result"></div>
		</div>
		</div>
		<br/>
		<br/>
<br/>
<br/><input type="submit" value="Get My Price!" class="btn btn-success btn-lg" >
	<br/>
	<br/>
	<br/>
	<br/>
	</form>
	

	
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    
</body>

</html>