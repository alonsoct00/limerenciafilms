<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "g.alonso.ct@gmail.com";
    $email_subject = "Contacto desde sitio web";
 
    function died($error) {
        // your error code can go here
        echo "Hemos encontrado errores en tus datos, por favor verifica. ";
        echo "<br /><br />";
        echo $error."<br /><br />";
        echo "Revisa e intenta nuevamente.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['comments'])) {
        died('Por ahora no podemos procesar tus comentarios, intenta mas tarde.');       
    }
 
     
 
    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $subject = $_POST['subject']; // required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo electrónico no es correcta.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Ingresa tu nombre.<br />';
  }

 
  if(strlen($comments) < 2) {
    $error_message .= 'Ingresa tus comentarios.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalles:.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Asunto: ".clean_string($subject)."\n";
    $email_message .= "Comentarios: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<div style="font-size: 12px; color:#333; font-family: Arial, sans-serif;text-align: center;">Gracias por contactarnos, revisaremos tus comentarios y en caso necesario nos comunicaremos contigo.</div>
 
<?php
 
}
?>