<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require  ('fpdf182/fpdf.php');
require ('vendor/autoload.php');


class Invoice {

    private $db;

    public function __construct()
    {
        $db = new Database();
    }

    private function getData($orderReceiptID) {

        // fetch data for the given order receiptID
        $query = "SELECT Receipt.orderReceiptID, Receipt.date, Receipt.totalPrice, 
        PM.method, ST.status, OT.  quantity, TKT.ticketPrice, EV.event_name FROM order_receipt as 
        Receipt JOIN payment_method as PM ON Receipt.paymentMethodID = PM.paymentMethodID 
        JOIN orders AS ORD ON Receipt.orderID = ORD.orderID JOIN order_status AS ST ON 
        ORD.orderStatusID = ST.orderStatusID JOIN order_ticket AS OT ON Receipt.orderID 
        = OT.orderID JOIN tickets AS TKT ON ORD.ticketID = TKT.ticketID JOIN event AS 
        EV.event_id = TKT.event_id WHERE Receipt.orderReceiptID=?";

        // conver recived row to a user presentable string 
        // return this string.
        return $query;
    }

    public function sendMail($path) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'user@example.com';                     //SMTP username
            $mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        
            //Attachments
            
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Haarlem festival tickets';
            $mail->Body    = 'Find your tickets for the festival below';
            
            $mail->AddAttachment($path, '', $encoding = 'base64', $type = 'application/pdf');
            
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    public function getQRCode($orderReceiptID) {

        $data = $this->getData($orderReceiptID);
        // convert the data to QRcode.
    }

    public function getInvoice($orderReceiptID) {
        
        $data = $this->getData($orderReceiptID);
        // A4 width: 219mm
        // default margin: 10mm each side
        // writeable horizonal: 219-(10*2)=189mm
        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();

        // set font to artial bold 14pt
        $pdf->SetFont('Arial', 'B', 14);

        //Cell (width, height, text, border 0 or 1, endline, [align])
        $pdf->Cell(130, 5, 'Haarlem Festival', 1, 0);
        $pdf->Cell(59, 5, 'INVOICE', 1, 1); // end of line

        // setting font to artial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(130, 5, 'Haarlem Festival', 1, 0);
        $pdf->Cell(59, 5, 'INVOICE', 1, 1); // end of line
        
        $pdf->Output("Test Invoice.pdf","F");

        $this->sendMail("Test Invoice.pdf");
        
    }
}