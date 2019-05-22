<?php
require 'PHPMailerAutoload.php';
$url = "https://www.formget.com/feed/";
$xml = simplexml_load_file($url);
$pollids = "savecont.txt"; // txt file contain title of already uploaded blog
$contents = file_get_contents($pollids); //string contains list of titles seprated by commas
$data="";
$new="";
for($i=0;$i<10;$i++)
{
$a= $xml->channel->item[$i]->title.","; //this method works to fetch data from xml array
$data.=$a; // $data contains titles of current uploaded blogs
if (strpos($contents,$a) !== false) {
}
else{
$new.=$a; //contains titles newly uploaded blogs
}
}
$newblogs = explode(',', $new); // array contains title of new blogs uploaded
fopen('savecont.txt', 'w+');
$ret = file_put_contents('savecont.txt', $data, FILE_APPEND | LOCK_EX); //update the list of blog title in text file
?>
<?php
$url = "https://www.formget.com/feed/";
$xml = simplexml_load_file($url);
$max = sizeof($newblogs); // contains number of new blogs
for($m=0;$m<$max;$m++)
{
$n=$newblogs[$m]; //contains title of new uploaded blog
$t=$xml->channel->item[$m]->title; // contains titles of blogs of website
if($n==$t)
{
echo "same string";
$a=$xml->channel->item[$m]->title; //set name of title
$b=$xml->channel->item[$m]->description; // set discription of blog in mail
$c=$xml->channel->item[$m]->link; // set name of the link of discription
?>
<?php
$mail = new PHPMailer;
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'formget.dev@gmail.com'; // SMTP username
$mail->Password = 'formgetmb'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
$mail->From = 'formget.dev@gmail.com';
$mail->FromName = 'Formget';
$pollids = "data.txt";
$contents = file_get_contents($pollids);
$cont = explode(',', $contents); // contains number of emails
foreach ($cont as $item) {
$mail->addAddress($item); // Add a recipient
}
$mail->isHTML(true);
$mail->SingleTo = true;// if u want to send email to multiple users
$mail->Subject = 'Here is the subject';
$mail->Body = '<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Single Extention </title>
</head>
<body style="font-size: 45px;font-family: proxima_nova_rgregular, sans-serif;font-size: 16px;line-height: 28px;">
<!-- Middle Section -->
<div align="center" style="border:1px,red,solid;">
<div align="center" id="padd" style="width:815px;border-style: solid;border-color: #D5D5D5;padding:30px;background-color:#F2F2F2;" >
<div style=""><img src="https://ci5.googleusercontent.com/proxy/uQRkR4RIRhQ7LPTHiI4BHEaGun2LR1WJRBOVFkRovNdPC55ysLASrCmwaf-aSXsv4M4B51-4IFjQmIvRCFPHxI4PLAvgL_oWkaeZJFZwEHrprw8P-UiZIfpFFy9u18SxCT0cLwFOJ4ffmjJScFPgClc=s0-d-e1-ft#https://www.formget.com/mailget/upload_files/1431944509-1601297505-Formget_welcome_email_png"/></div>
<div id="division1" style="width:585px;border-style: solid;border-color: #D5D5D5;background-color:#ffffff;" align="center">
<h2>'.$a.'</h2>
<div class="extension-desc" align="center">
<p style="margin:0 15px;">'.$b.'</p>
<p><b>for more details click here</b>'.$c.'</p>
</div>
</div>
</div>
</div>
</body>
</html>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent';
}
}
}
header('Location: subscription-popup.php');
?>
