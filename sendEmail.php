<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
 

   
    if(isset($data['name']) && isset($data['email'])){
        
        $email = $data['email'];
        $header = "ชื่อ: ".$data['name']."\n";
        $name = "ลงทะเบียนโครงการ";
        $fm = 'mailform@solacecondo.com';

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();
        $mail->CharSet = "utf-8"; 
        $message.= "Solace: ".$data['name']."<br>";
        $message.= "อีเมล์: ".$data['email']."<br>";
        $message.= "หมายเลขโทรศัพท์: ".$data['tel']."<br>";
        $message.= "ID Line: ".$data['id_line']."<br>";


        $detail = $message;

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = "thsv44.hostatom.com";
        $mail->SMTPAuth = true;
        $mail->Username = "mailform@solacecondo.com"; // enter your email address
        $mail->Password = "Solace259"; // enter your password
        $mail->Port = "587";
        //$mail->SMTPSecure = "ssl";

        //Email Settings

        $mail->isHTML(true);
        $mail->setFrom($fm, $name);
        $mail->addAddress($email); // Send to mail
        $mail->Subject = $header;
        $mail->Body = $detail;

        //cc
        $mail->AddCC("solacecondo@capitalone.in.th");
        $mail->AddCC("vit@c1re.co.th");
        $mail->AddCC("sale@solacecondo.com");
        $mail->AddCC("design.wisdomstudio@gmail.com");
       


        if($mail->send()) {
            $status = "success";
            $response = "Email is sent";
        } else {
            $status = "failed";
            $response = "Something is wrong" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }else {
    $status = "failed";
    $response = "Incomplete or incorrect data received";
    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>