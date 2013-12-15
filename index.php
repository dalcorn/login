<!DOCTYPE html>
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="style.css">
        <title>Assignment 1 D. Alcorn</title>
    </head>

<?php

$name = '';
$email = '';
$account_no = '';
$message = "";
 
if($_SERVER['REQUEST_METHOD'] == "POST"){
$name = $_POST['name'];
$email = $_POST['email'];
$account_no = $_POST['account_no'];
$message = "";
//validate name   
    if(!empty($name)) {
       $name = trim($_POST['name']); 
    }else{
        $name = NULL;
    }
//validate email according to specs 
// normally I would use: 
//filter_var($email, FILTER_VALIDATE_EMAIL)
    if (strpos($_POST['email'], '@') !== FALSE && 
               $_POST['email'][0] !== '@'){
           $email = $_POST['email'];
    }else{
            $email = NULL;           
     }
//validate account number according to specs
//8 digit account number with optional hyphen after first number		
		$pattern1 = '/^[0-9]{1}\-?[0-9]{7}$/';  
//8 digit account number without hyphen		
		$pattern2 = '/^[0-9]{8}$/'; 
 	if(preg_match($pattern1, $_POST['account_no']) && 
 	strpos($_POST['account_no'], '-') !== FALSE ){
			$beg = substr($_POST['account_no'],0,1);
			$end = substr($_POST['account_no'],3);
			$account_no = $beg.$end;
	}elseif(preg_match($pattern2, $_POST['account_no']) ){
			$account_no = $_POST['account_no'];
	}else{
       		$account_no = NULL;       
   		}
		
   $message = '<div class="summary" >
            <p>Hello, '. $name. '. Your account number is ' . '****'. substr($account_no, 3) .'<p>
            </div>';
    
   if(isset($name, $email, $account_no)) {
        echo $message;
        $name = '';
        $email = '';
        $account_no = '';
    	}else{ 
			$nameError =
             '<div class="error" ><p>-Name is blank.</p></div>';
			$emailError =
            '<div class="error" ><p>-Email is invalid.</p></div>';
			$accountError =
             '<div class="error" ><p>-Account number is invalid.</p></div>';
            	
        echo'<div class="summary" >Please correct these errors:</div>';
//display error message(s)		
        if(!$name){          
            echo $nameError ;
        }if(!$email ){         	
           	echo $emailError;		   
        }if(!$account_no){
           	echo $accountError . "\n";
            }
		}
	}
?>
        <!-- html form -->

   
    <body>
        <div>
            
            <form action="" method ="POST">
                <p>Name: <input type='text' name='name' size='20'
                           maxlength='40' value="<?php echo $name ?>" /></p>
                <p>Email: <input type='text' name='email' 
                         size='40' maxlength='60' value="<?php echo $email ?>"/> </p>
                <p>Account Number: <input type='text' name='account_no' 
                                          size='10' value="<?php echo $account_no ?>"/> </p>               
                 
                <p><input class='button' type='submit' name='submit' value='Submit' /> </p>
            </form> 
                 
        </div>
    </body>
</html>
