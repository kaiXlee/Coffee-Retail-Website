<?php

    //$email =$_POST['email'];
    $email = 'lynnlin0510@gmail.com';

    public function sendMail($email, $userId)
{
   $to = $email;
$subject = 'Password Reset';

$bound_text = "----*%$!$%*";
$bound = "--".$bound_text."\r\n";
$bound_last = "--".$bound_text."--\r\n";

$headers = "From: noreply@somewhere.com\r\n";
$headers .= "MIME-Version: 1.0\r\n" .
        "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;

$message = " you may wish to enable your email program to accept HTML \r\n".
        $bound;

    $message .=
  'Content-Type: text/html; charset=UTF-8'."\r\n".
  'Content-Transfer-Encoding: 7bit'."\r\n\r\n".
  '

        <BODY BGCOLOR="White">
        <body>

        </br>
        <div style=" height="40" align="left">

        <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
        <div class="info" Style="align:left;">

        <p>place link here for password reset</p>

         <p>Reference Number: '.$userId.'</p>

                        </div>

        </br>
        <p>-----------------------------------------------------------------------------------------------------------------</p>
        </br>
        <p>( This is an automated message, please do not reply to this message, if you have any queries please contact someone@someemail.com )</p>
        </font>
        </div>
        </body>
    '."\n\n".
                                                                $bound_last;

$sent = mail($to, $subject, $message, $headers); // finally sending the email


}


    function createRandomPassword() {
    $chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
    $i = 0;
    $pass = '' ;

    while ($i <= 8) {
        $num = mt_rand(0,61);
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
    }

    $pw = createRandomPassword();
    $query = "UPDATE users SET password= SHA1('$pw') WHERE email = '$email' ";
    $result = mysqli_query($link, $query);
if ($result){
$query3 = "SELECT * FROM users where email = '$email'";
$sql = mysqli_query($link, $query3) or die(mysqli_error());
$rownum = mysqli_num_rows($sql);

if(!$rownum  ) {
   echo "We can not find your email in our records";
    }

    }
   if($result){
   $this->sendMail($email, $userId); /*does it need to be in a class for $this->? or can you call       functions within the php page without?*/
}
?>
