<?php

/*CLASS User Definition*/

    //require database connection file
    require "db_config.php";

   //defne location for error logs file
    define('ERROR_LOG','C:/Temp/logs/errors.log');

        class User
        {
            public $db;
            protected array $errors = [];

            public function __construct()
            {

            //connection to database
            try {
                $this->db = new PDO("mysql:host=localhost;port=3307;dbname=storedb", DB_USERNAME, DB_PASSWORD);
                
                //if(mysqli_connect_errno())
            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
                //{
                   // echo "Error: Could not connect to database.";
                    //exit;
                //}
            }



           //get errors function
            public function getErrors() {
                return $this->errors;
            }



        //function to sanitize value or input 
        public function safe($text) {
                $text = trim($text);               
                $bad_chars = array( "{", "}", "(", ")", ";", ":", "<", ">", "/", "$" );
                $text = str_ireplace($bad_chars, "", $text);        
                return htmlspecialchars($text, ENT_COMPAT|ENT_HTML5, 'UTF-8', false);
                }


        //validate and sanitize 'first name' value 
        public function validateFirstname($first_name, $fieldname) {
            $first_name = trim($this->safe($_POST[$fieldname]));           
            if ((!empty($first_name)) && (preg_match('/[a-z\s]/i',$first_name)) && (strlen($first_name) <= 35)) {               
                //Sanitize the trimmed first name
                $first_name = filter_var( $_POST[$fieldname], FILTER_SANITIZE_STRING);
                $first_name = (filter_var($first_name, FILTER_SANITIZE_STRIPPED));   
            } else {    
                $this->errors[] = 'First Name missing or not alphabetic and space characters. Max 30';
               // return false;
            }
             return $first_name;

        }

       //validate and sanitize 'last name' value
        public function validateLastname($last_name, $fieldname) {
            $last_name = trim($this->safe($_POST[$fieldname]));         
            if ((!empty($last_name)) && (preg_match('/[a-z\-\s\']/i',$last_name)) && (strlen($last_name) <= 45)) {                   
               //Sanitize the trimmed last name
              $last_name = filter_var( $_POST[$fieldname], FILTER_SANITIZE_STRING);
              $last_name = (filter_var($last_name, FILTER_SANITIZE_STRIPPED));           
            } else {    
               $this->errors[] = 'Last name missing or not alphabetic, dash, quote or space. Max 30.';
              // return false;
            }
            return $last_name; 
        }

        //validate and sanitize 'username' value
        public function validateUsername($username, $fieldname) {
            $username = trim($this->safe($_POST[$fieldname]));   
            if ((!empty($username)) && (preg_match('/^[-_\p{L}\d]+$/ui',$username)) && (strlen($username) <= 15)) {              
               //Sanitize the trimmed first name
               $username = filter_var( $_POST[$fieldname], FILTER_SANITIZE_STRING);
               $username = (filter_var($username, FILTER_SANITIZE_STRIPPED));               
            } else {    
               $this->errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
               //return false;
            }
            return $username;
        }


       //validate and sanitize 'email' value
        public function validateEmail($email, $fieldname) {
            $email = trim($_POST[$fieldname]);
            if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $this->errors[] = 'You forgot to enter your email address';
                $this->errors[] = ' or the e-mail format is incorrect.';
               // return false;
            } else {
               $email = filter_var( $_POST[$fieldname], FILTER_SANITIZE_EMAIL);
            }
            return $email;
        }

        //validate and sanitize 'password' value
        public function validatePassword($u_pass1, $u_pass2, $fieldname1, $fieldname2) {
             $u_pass1 = trim($this->safe($_POST[$fieldname1]));
             $u_pass1 = filter_var($_POST[$fieldname1], FILTER_SANITIZE_STRING);
             $u_pass1 = (filter_var($u_pass1, FILTER_SANITIZE_STRIPPED));
             $string_length = strlen($u_pass1);    

             if (empty($u_pass1) && ($string_length > 12)) {   
                $this->errors[] ='Please enter a valid password';
                return false;
              } else {
                 if (!preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,12}$/', $u_pass1)) {            
                    $this->errors[] = 'Invalid password, 8 to 12 chars, one upper, one lower, one number, one special.';
                    return false;
                 } else {
               $u_pass2 = trim($this->safe($_POST[$fieldname2]));
               $u_pass2 = filter_var( $_POST[$fieldname2], FILTER_SANITIZE_STRING); 

               if($u_pass1 === $u_pass2) { 
                  $password = $u_pass1;
                  return $password;
                } else {
                    $this->errors[] = 'Your two password do not match.';
                    $this->errors[] = 'Please try again';
                    return false;
                }
            }
           }
               

        }


        //validate and sanitize 'address' value
        public function validateAddress($address, $fieldname) {
            $address = trim($this->safe($_POST[$fieldname]));       
            if ((!empty($address)) && (preg_match('/[a-z0-9\.\s\,\-]/i', $address)) && (strlen($address) <= 30)) {
               $address = (filter_var($address, FILTER_SANITIZE_STRING));
               $address = (filter_var($address, FILTER_SANITIZE_STRIPPED));                      
            } else {  
               $this->errors[] = 'Missing address. Only alphabetic, number, period, comma, dash and space. Max 30.';
               //return false;
            }
            return $address;
        }


        //validate and sanitize 'country' value
        public function validateCityStateCountry($name, $fieldname) {
            $name = trim($this->safe($_POST[$fieldname]));     
            if ((!empty($name)) && (preg_match('/[a-z\.\s]/i', $name)) && (strlen($name) <= 30))  {                    
               $name = (filter_var($name, FILTER_SANITIZE_STRING)); 
               $name = (filter_var($name, FILTER_SANITIZE_STRIPPED));                     
            } else {  
               $this->errors[] = 'Missing city/state/country. Only alphabetic, period and space. Max 30.';
              // return false;
            }
           return $name;

        }

        //validate and sanitize 'zip' value
        public function validateZipcode($zip, $fieldname) {
            $zip = trim($this->safe($_POST[$fieldname]));     
            if ((!empty($zip)) && (preg_match('/[a-z0-9\s]/i', $zip)) && (strlen($zip) <= 30)) {                        
               //Sanitize the trimmed zcode_pcode                      
               $zip = (filter_var($zip, FILTER_SANITIZE_STRING));  
               $zip = (filter_var($zip, FILTER_SANITIZE_STRIPPED));                    
            } else {  
               $this->errors[] = 'Missing zip code or post code. Alphabetic, numeric, space only max 30 characters';
              // return false;
            }
            return $zip;
        }


        //validate and sanitize 'intro' value
        public function validateIntro($intro, $fieldname) {
            $intro = trim($this->safe($_POST[$fieldname]));       
            if ((!empty($intro)) && (preg_match('/[a-z0-9\.\s\,\-]/i', $intro)) && (strlen($intro) <= 40)) {
               $intro = (filter_var($intro, FILTER_SANITIZE_STRING));
               $intro = (filter_var($intro, FILTER_SANITIZE_STRIPPED));                      
            } else {  
             
               $intro = NULL;
        
            }
            return $intro;
        }


       //validate and sanitize 'secret' value
        public function validateSecret($secret, $fieldname) {
            //Is the secret present? If it is, trim it and sanitize it
            $secret = trim($this->safe($_POST[$fieldname]));       
            if ((!empty($secret)) && (preg_match('/[a-z\.\s\,\-]/i', $secret)) && (strlen($secret) <= 30)) {                    
                //Sanitize the trimmed city                     
                $secret = (filter_var($secret, FILTER_SANITIZE_STRING));  
                $secret = (filter_var($secret, FILTER_SANITIZE_STRIPPED));                      
            } else {  
                $this->errors[] = 'Missing secret. Only alphabetic, period, comma, dash and space. Max 30.';
                //return false;
            }
            return $secret;
        }

        //validate and sanitize 'phone number' value
        public function validateTel($phone, $fieldname) {
            //Is the phone number present? If it is, trim it and sanitize it     
            $phone = trim($this->safe($_POST[$fieldname]));     
            if ((!empty($phone)) && (strlen($phone) <= 30)) {                   
               //Sanitize the trimmed phone number 
               $phone = (filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
               $phone = preg_replace('/[^0-9]/', '', $phone);      
            } else {  
               $phone = NULL;
            }
            return $phone;
        }


         //validate and sanitize 'subject' value
          public function validateSubject($subject, $fieldname) {
            $subject = trim($this->safe($_POST[$fieldname]));         
            if ((!empty($subject)) && (preg_match('/[a-z\-\s\']/i',$subject)) && (strlen($subject) <= 30)) {                   
               //Sanitize the trimmed last name
              $subject = filter_var( $_POST[$fieldname], FILTER_SANITIZE_STRING);
              $subject = (filter_var($subject, FILTER_SANITIZE_STRIPPED));           
            } else {    
               $this->errors[] = 'Last name missing or not alphabetic, dash, quote or space. Max 30.';
              // return false;
            }
            return $subject; 
        }

       //validate and sanitize 'message' value
        public function validateMessage($message, $fieldname) {
            $message = trim($this->safe($_POST[$fieldname])); 
            if ((!empty($message)) && (strlen($message) <= 500)) {
               // remove ability to create link in email
               $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
               $message = preg_replace($patterns," ", $message);
               $message = filter_var( $message, FILTER_SANITIZE_STRING);
               $message = (filter_var($message, FILTER_SANITIZE_STRIPPED));
            } else { // if comment not valid display error page
               $this->errors[] = 'you forgot to enter Facilities ';
               $this->errors[] = 'Or exceeded max number of characters';
            }
        }

         //validate and sanitize 'search' value
         public function validateSearch($search, $fieldname) {
            $search = trim($this->safe($_POST[$fieldname])); 
            if ((!empty($search)) && (strlen($search) <= 20)) {
               // remove ability to create link in email
               $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
               $search = preg_replace($patterns," ", $search);
               $search = filter_var( $search, FILTER_SANITIZE_STRING);
               $search = (filter_var($search, FILTER_SANITIZE_STRIPPED));
            } else { // if comment not valid display error page
               $this->errors[] = 'you forgot to enter text in field ';
               $this->errors[] = 'Or exceeded max number of characters';
            }
        }



       //function to register users
        public function registerUser($firstname, $lastname, $username, $email, $password, $address, $zip, $state, $country, $phone) {
                //$password=md5($password);
                //$sql="SELECT * FROM manager WHERE uname='$username' OR uemail='$email'";
                //$check=$this->db->query($sql);
                //$count_row=$check->num_rows;
            
                $sql="SELECT * FROM users WHERE u_name=:username OR email=:email";
                $stmt = $this->db->prepare($sql);
                // bind parameters and insert the details into the database
                   $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                   $stmt->execute();
                //$q = mysqli_stmt_init($this->db);
                //mysqli_stmt_prepare($q, $query);
                //mysqli_stmt_bind_param($q,'ss', $username, $email );
                //mysqli_stmt_bind_param($q,'s', $email);
                //mysqli_stmt_execute($q);
                //$count_row = mysqli_stmt_get_result($q);
                //$KEY = 'Trav3lw@rldwitTh@nd33';
                //if($count_row==0) {


                   //insert data if email doesn't exist
                if ($stmt->rowCount() == 0) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                  try {  
                        
                  // $sql1="INSERT INTO users (first_name, last_name, u_name, email, pass, street, zip, state, country, tel) 
                  // VALUES (:firstname, :lastname, :uname, :uemail,  AES_ENCRYPT(:pwd, :ky), :addrss, :zcode, :cty, :cntry, :phne)";

                   $sql1="INSERT INTO users (first_name, last_name, u_name, email, pass, street, zip, state, country, tel) 
                   VALUES (:firstname, :lastname, :uname, :uemail, :pwd, :addrss, :zcode, :cty, :cntry, :phne)";
                   $stmt = $this->db->prepare($sql1);
                   // bind parameters and insert the details into the database
                   $stmt->bindParam(':uname', $username, PDO::PARAM_STR);
                   $stmt->bindParam(':uemail', $email, PDO::PARAM_STR);
                   $stmt->bindParam(':pwd', $hashed_password, PDO::PARAM_STR);
                   // $stmt->bindParam(':ky', $KEY, PDO::PARAM_STR);
                   $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                   $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                   $stmt->bindParam(':addrss', $address, PDO::PARAM_STR);
                   $stmt->bindParam(':zcode', $zip, PDO::PARAM_STR);
                   $stmt->bindParam(':cty', $state, PDO::PARAM_STR);
                   $stmt->bindParam(':cntry', $country, PDO::PARAM_STR);
                   if (empty($phone)) {
                        $stmt->bindValue(':phne', NULL, PDO::PARAM_NULL);
                    } else {
                        $stmt->bindParam(':phne', $phone, PDO::PARAM_STR);
                    }

                   $result= $stmt->execute();

                    return $result;

                   } catch (PDOException $e) {
                        if ($e->getCode() == 23000) {
                            $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                            Please choose another username.';
                        } else {
                            $this->errors[] = $e->getMessage();
                            $this->errors[] = "Data can't be retrieved";
                            // print "An Exception occurred. Message: " . $e->getMessage();
                            //print "The system is busy please again try later";
                            // $date = date('m.d.y h:i:s');                
                            // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                            // error_log($eMessage,3,ERROR_LOG);
                            // e-mail support person to alert there is a problem
                            // error_log("Date/Time: $date - Exception Error, Check error log for
                            //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                            // Error Log <errorlog@helpme.com>" . "\r\n");
                    
                       }
                  }  catch (PDOError $e) {
                    $this->errors[] = $e->getMessage();
                    $this->errors[] = "Data cannot be retrieved";
                    // print "An Error occurred. Message: " . $e->getMessage();
                    // print "The system is busy please try later";
                    // $date = date('m.d.y h:i:s');        
                    // $eMessage = $date . " | Error | " , $errormessage . |\n";
                    // error_log($eMessage,3,ERROR_LOG);
                    // e-mail support person to alert there is a problem
                    // error_log("Date/Time: $date - Error, Check error log for
                    //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                    // <errorlog@helpme.com>" . "\r\n");
    
                 }
                } else {  
                        $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                        Please choose another username.';
                        return false;
                     }
                }


            //function to update user data
            public function updateUser($firstname, $lastname, $username, $email, $address, $zip, $state, 
                $country, $phone, $intro, $userId) {
                try {
                          
                       $sql1="UPDATE users SET u_name=:uname, first_name=:firstname, last_name=:lastname, email=:uemail, 
                       street=:addrss, zip=:zp, state=:stte, country=:cntry, tel=:phne, intro=:intr WHERE user_id=:id";
                       $stmt = $this->db->prepare($sql1);
                       // bind parameters and insert the details into the database
                       $stmt->bindParam(':uname', $username, PDO::PARAM_STR);
                       $stmt->bindParam(':uemail', $email, PDO::PARAM_STR);
                       $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                       $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                       $stmt->bindParam(':addrss', $address, PDO::PARAM_STR);
                       $stmt->bindParam(':zp', $zip, PDO::PARAM_STR);
                       $stmt->bindParam(':stte', $state, PDO::PARAM_STR);
                       $stmt->bindParam(':cntry', $country, PDO::PARAM_STR);

                        if (empty($phone)) {
                          $stmt->bindValue(':phne', NULL, PDO::PARAM_NULL);
                        } else {
                          $stmt->bindParam(':phne', $phone, PDO::PARAM_STR);
                       }

                       if (empty($intro)) {
                          $stmt->bindValue(':intr', NULL, PDO::PARAM_NULL);
                        } else {
                          $stmt->bindParam(':intr', $intro, PDO::PARAM_STR);
                       }

                       $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                       
    
                       $result= $stmt->execute();
    
                       return $result;
    
                       
                     $sql1="SELECT * FROM users WHERE u_name=:username OR email=:uemail";
                     $stmt1 = $this->db->prepare($sql1);

                     // bind parameters and insert the details into the database
                        $stmt1->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt1->bindParam(':uemail', $email, PDO::PARAM_STR);
                        $stmt1->execute();
 
                       // if email exists display message
                        if ($stmt1->rowCount() == 1) {
                            $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                            Please choose another username.';
                            return false;
                         }

                         } catch (PDOException $e) {
                            if ($e->getCode() == 23000) {
                                $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                                Please choose another username.';
                            } else {
                                $this->errors[] = $e->getMessage();
                                $this->errors[] = "Data can't be retrieved";
                                // print "An Exception occurred. Message: " . $e->getMessage();
                                //print "The system is busy please again try later";
                                // $date = date('m.d.y h:i:s');                
                                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                                // error_log($eMessage,3,ERROR_LOG);
                                // e-mail support person to alert there is a problem
                                // error_log("Date/Time: $date - Exception Error, Check error log for
                                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                                // Error Log <errorlog@helpme.com>" . "\r\n");
                
                        
                           }
                      }  catch (PDOError $e) {
                        $this->errors[] = $e->getMessage();
                        $this->errors[] = "Data cannot be retrieved";
                        // print "An Error occurred. Message: " . $e->getMessage();
                        // print "The system is busy please try later";
                        // $date = date('m.d.y h:i:s');        
                        // $eMessage = $date . " | Error | " , $errormessage . |\n";
                        // error_log($eMessage,3,ERROR_LOG);
                        // e-mail support person to alert there is a problem
                        // error_log("Date/Time: $date - Error, Check error log for
                        //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                        // <errorlog@helpme.com>" . "\r\n");
        
                     }
                }
            
            
       
       //function to check and process login data
        public function check_login($emailusername,$password) {
                
                try {

                $KEY = 'Trav3lw@rldwitTh@nd33';
                //$sql = "SELECT user_id, u_name, email, user_level, AES_ENCRYPT(pass, :ky) AS pwd from users
                // WHERE (email=:emailuser OR u_name=:emailuser) AND pass = AES_ENCRYPT(:pwd, :ky)";
                $sql = "SELECT user_id, u_name, email, pass, user_level FROM users WHERE email=:emailuser OR u_name=:emailuser";
                $stmt = $this->db->prepare($sql);
                //$stmt->execute([$emailusername, $emailusername, $password, $KEY]);
                $stmt->bindParam(':emailuser', $emailusername, PDO::PARAM_STR);              
                //$stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
                //$stmt->bindParam(':ky', $KEY, PDO::PARAM_STR);
                $stmt->execute();
                $user_data = $stmt->fetch();
                $count_row = $stmt->rowCount(); 

                
                //set session variables if login is successful
                if ($count_row > 0) {
                    if (password_verify($password, $user_data['pass'])) {
                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['uid'] = $user_data['user_id'];
                        $_SESSION['username'] =  $user_data['u_name'];
                        $_SESSION['email'] =  $user_data['email'];
                        $_SESSION['user_level'] =  $user_data['user_level'];
                        $_SESSION['start'] = time();
                        session_regenerate_id();
                        $url = ($_SESSION['user_level'] === 1) ? 'admin/admin.php' : 'index.php';
                        header('Location: ' . $url);
                        return true;    
                    } else {
                        $this->errors[] = "Username, email is incorrect";
                        $this->errors[] = "Or password is incorrect";
                        $this->errors[] = 'Perhaps you need to register, just click the Register ';
                        return false;
                    }
                } else {
                    $this->errors[] = "Username Or email is incorrect";
                    $this->errors[] = "Or password is incorrect";
                    $this->errors[] = 'Perhaps you need to register, just click the Register ';
                }
            
            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
        }

            //get session variable 'login'
            public function get_session() {
                return $_SESSION['login'];
            }

           
            //logout function
             public function user_logout() {
                $_SESSION['login'] = false;
                $_SESSION = [];
                // invalidate the session cookie
                if (isset($_COOKIE[session_name()])) {
                    setcookie(session_name(), "", time()-86400, '/');
                }
                session_destroy();
            }


           //function to insert cart data function
            public function addCart($prodId, $userId, $sessionId, $size, $color, $qnty) {
               
                try {

                $status = "Added to cart";

                $sql = "insert INTO cart (userId,sessionId,status) VALUES (:userid, :sessId,:sts)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':sessId', $sessionId, PDO::PARAM_INT);
                $stmt->bindParam(':sts', $status, PDO::PARAM_STR);
                $stmt->execute();
                // use rowCount() to get the number of affected rows
                $OK = $stmt->rowCount();
                       
                // get the image's primary key or find out what went wrong
                if ($OK) {
                    // lastInsertId() must be called on the PDO connection object
                    $cartId = $this->db->lastInsertId();
                 } //else {
                           // continue;

                $sql = "insert INTO cart_item (productId, cartId, size, color, quantity ) VALUES (:prodid,:cartid ,:sze, :color,:qnty)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':prodid', $prodId, PDO::PARAM_INT);
                $stmt->bindParam(':cartid', $cartId, PDO::PARAM_INT);
                 $stmt->bindParam(':sze', $size, PDO::PARAM_STR);
                $stmt->bindParam(':color', $color, PDO::PARAM_STR);
                $stmt->bindParam(':qnty', $qnty, PDO::PARAM_INT);
                $result = $stmt->execute();
                return $result;


            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }

                        
            }

            
            //check if item is already added to cart 
            public function checkIfAddedToCart($prodId, $userId) {
             
                $status = "Added to cart";
                $sql = "SELECT * FROM cart LEFT JOIN cart_item ON cart.id = cart_item.cartId
                 WHERE productId=:prodid AND userId=:uid AND status=:sts";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':prodid', $prodId, PDO::PARAM_INT);
                $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':sts', $status, PDO::PARAM_STR);
                $result = $stmt->execute();
                //$result = $this->db->query($sql);
                $num_rows = $stmt->rowCount();
                if ($num_rows>=1) return 1;
                return 0;
        }


           //function to delete cart data 
           public function removeCart($prodId) {

            try {

               $sql1 = "SELECT *, i.id AS pId, j.id AS cId FROM cart as i LEFT JOIN cart_item as j 
               ON j.cartId = i.id WHERE j.productId = :prodid ";
              $stmt = $this->db->prepare($sql1);
              $stmt->bindParam(':prodid', $prodId, PDO::PARAM_INT);
              $result1 = $stmt->execute();
               //$result1 = $this->db->query($sql1);
               $row = $stmt->fetch();

               $cartId = $row['pId'];


               $sql2 = "DELETE FROM cart WHERE id='$cartId'";
               $this->db->query($sql2);

                $cartItemId = $row['cId'];
                $sql = "DELETE FROM cart_item WHERE id='$cartItemId'";
                $result = $this->db->query($sql);
                return $result;

                 } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }


           }


          //insert data to wishlist 
           public function addWishlist($productId, $userId) {
               
                try {
                $status = "Added to wishlist";

                $sql = "insert INTO wishlist (userId,productId,status) VALUES (:userid, :prodId,:sts)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':prodId', $productId, PDO::PARAM_INT);
                $stmt->bindParam(':sts', $status, PDO::PARAM_STR);
                $result = $stmt->execute();
                return $result;


            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }

                        
            }



           //check if item is already added to wishlist 
            public function checkIfAddedToWishlist($prodId, $userId) {
             
                //$userId = $_SESSION['id'];
                $sql = "SELECT * FROM wishlist WHERE productId='$prodId' AND userId='$userId' AND status='Added to wishlist'";
                $result = $this->db->query($sql);
                $num_rows = $result->rowCount();
                if ($num_rows>=1) return 1;
                return 0;
        }



         //remove from wishlist
         public function removeWishlist($prodId) {

            try {


               $sql = "DELETE FROM wishlist WHERE productId='$prodId'";
                $result = $this->db->query($sql);
                return $result;

                 } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }


           }

 
          //function to sort info(items)
           public function sortCategory($type, $category, $sortOption, $startRow) {

            try {

             $sql="SELECT *, i.id AS pId, i.discount AS disc FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
                 WHERE (i.type='$type' AND z.categoryName='$category') ORDER BY $sortOption LIMIT $startRow, " .SHOWMAX;
           //$stmt = $user->db->prepare($sql);
           //$stmt->bindParam(':Sort', $sort, PDO::PARAM_STR);              
           //$stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
           //$result = $stmt->execute();
           $result = $this->db->query($sql);
           return $result;


             } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
       }



           //function to sort info
           public function sortFullCategory($category, $sortOption, $startRow) {

            try {
                $sql="SELECT *, i.id AS pId, i.discount AS disc FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId 
                 RIGHT JOIN  category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
                 WHERE (z.categoryName='$category') ORDER BY $sortOption LIMIT $startRow,". SHOWMAX;
               $result = $this->db->query($sql);
               return $result;


             } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
       }


 

        //function to get total number of sorted items
        public function getTotalSortCategory($type, $category, $startRow) {

            try {

            $getTotal = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
                category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
                WHERE (z.categoryName='$category' AND i.type='$type') LIMIT $startRow, " .SHOWMAX;
           $total = $this->db->query($getTotal);
           $totalPix = $total->fetch()[0];
           return $totalPix;
      

             } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
       }


        //function to sort searched results
         public function sortSearch($searchedItem, $sortOption, $startRow) {

            try {
                 $sql="SELECT *, i.title AS prodName, t.title  AS tagName, i.id AS pId, i.discount AS disc FROM product as i LEFT JOIN Product_category as j ON i.id=j.productId LEFT JOIN category as z ON z.id=j.categoryId LEFT JOIN variant as k 
                    ON k.productId=i.id LEFT JOIN tag as t ON t.categoryId=z.id WHERE (i.title LIKE '%$searchedItem%')  
                    OR (type LIKE '%$searchedItem%')  OR (brand LIKE '%$searchedItem%')  OR (categoryName LIKE '%$searchedItem%')
                    OR (t.title LIKE '%$searchedItem%')  OR (color LIKE '%$searchedItem%') 
                    ORDER BY $sortOption LIMIT $startRow,". SHOWMAX;
                 $result = $this->db->query($sql);
                 return $result;


             } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

            } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | " , $errormessage . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

           }
       }



        //function to change user password
        public function changePassword($userId, $old_password, $password) {
                $result = false;

            try {

               $sql = "SELECT pass FROM users WHERE ( user_id=:uid )";
               $stmt = $this->db->prepare($sql);
               $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
               $stmt->execute();
               $row = $stmt->fetch();
               $count_row = $stmt->rowCount(); 


               //proceed to change password if current password is correct
               if (($count_row == 1) && password_verify($old_password, $row['pass'])) {

                   $hashed_passcode = password_hash($password, PASSWORD_DEFAULT);
                   $sql = "UPDATE users SET pass=:pwd WHERE user_id=:uid";
                   $stmt = $this->db->prepare($sql);
                   $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
                   $stmt->bindParam(':pwd', $hashed_passcode, PDO::PARAM_STR);
                   $result = $stmt->execute();
                   $changed = $stmt->rowCount();

                   if ($changed == 1) {
                      $done = "Password Changed";
                   } else {
                    $this->errors[] = "Password couldn't be changed try again later";
                   }                    


               } else {
                $this->errors[] = "Username and/or Password is incorrect.";

               }


               return $result;
            
        }  catch(Exception $e) // We finally handle any problems here
        {
        // print "An Exception occurred. Message: " . $e->getMessage();
        print "The system is busy please again try later";
        // $date = date('m.d.y h:i:s');
        $this->errors[] = $e->getMessage();
        // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
        // error_log($eMessage,3,ERROR_LOG);
         // e-mail support person to alert there is a problem
         // error_log("Date/Time: $date - Exception Error, Check error log for
        //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
        // Error Log <errorlog@helpme.com>" . "\r\n");
        } catch(Error $e) {
         // print "An Error occurred. Message: " . $e->getMessage();
         print "The system is busy please try later";
        // $date = date('m.d.y h:i:s');
        $this->errors[] = $e->getMessage();
        // $eMessage = $date . " | Error | " , $errormessage . |\n";
        // error_log($eMessage,3,ERROR_LOG);
        // e-mail support person to alert there is a problem
        // error_log("Date/Time: $date - Error, Check error log for
        //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
        // <errorlog@helpme.com>" . "\r\n");
        }



        }







}