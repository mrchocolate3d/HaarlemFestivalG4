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
        PM.method, ST.status, OT.quantity, TKT.ticketPrice, EV.event_name FROM order_receipt as 
        Receipt JOIN payment_method as PM ON Receipt.paymentMethodID = PM.paymentMethodID 
        JOIN orders AS ORD ON Receipt.orderID = ORD.orderID JOIN order_status AS ST ON 
        ORD.orderStatusID = ST.orderStatusID JOIN order_ticket AS OT ON Receipt.orderID 
        = OT.orderID JOIN tickets AS TKT ON ORD.ticketID = TKT.ticketID JOIN event AS 
        EV.event_id = TKT.event_id WHERE Receipt.orderReceiptID=?";
        
        return $query;
    }

    public function sendMail($path) {
        $mail = new PHPMailer(true);
        try {
                    $to = "abhishek.narvekar80@gmail.com";
                    $from = "abhishek.narvekar90@gmail.com";
                    $subject = "Please find your attachement below";
                    $mess = "test message";
                    $fileatt = "mypdf.pdf";
                    $fileatt_type = "application/pdf";
                    $fileatt_name = "invoice_tickets.pdf";
                    $headers = "From: $from";
                    $file = fopen($fileatt, "rb");
                    $data = fread($file, filesize($fileatt));
                    fclose($file);

                    $semi_rand = md5(time());
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                    // Add the headers for a file attachment
                    $headers .= "\
                    MIME-Version: 1.0\r\
                    ".

                    "Content-Type: multipart/mixed;\r\
                    " .
                            " boundary=\"{$mime_boundary}\"";

                    // Add a multipart boundary above the plain message
                    $message = "This is a multi-part message in MIME format.\r\
                    \r\
                    " .
                            "--{$mime_boundary}\r\
                    " .
                            "Content-Type: text/plain; charset=\"iso-8859-1\"\r\
                    " .
                            "Content-Transfer-Encoding: 7bit\r\
                    \r\
                    " .
                            $mess . "\r\
                    \r\
                    ";

                    // using the Base64 encode the file data
                    $data = chunk_split(base64_encode($data));

                    // Add file attachment to the message
                    $message .= "--{$mime_boundary}\r\
                    " .
                            "Content-Type: {$fileatt_type};\r\
                    " .
                            " name=\"{$fileatt_name}\"\r\
                    " .
                            "Content-Transfer-Encoding: base64\r\
                    \r\
                    " .
                            $data . "\r\
                    \r\
                    " .
                            "--{$mime_boundary}--\r\
                    ";

                    if (mail($to, $subject, $message, $headers))
                    {
                        echo "<p>The email was sent.</p>";
                    }
                    else
                    {
                        echo "<p>There was an error sending the mail.</p>";
                    }
                    return true;

                } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        return false;
                }

    }

    public function getInvoice($orderReceiptID) {
        
        $row = $this->getData($orderReceiptID);

        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Cell(130	,5,'Haarlem Festival',0,0);
        $pdf->Cell(59	,5,'INVOICE and tickets',0,1);//end of line

        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(25	,5,'Invoice and tickets #',0,0);
        $pdf->Cell(34	,5,$row['orderReceiptID'],0,1);//end of line

        $pdf->Cell(130	,5,'Fax [+12345678]',0,0);
        $pdf->Cell(25	,5,'Customer ID',0,0);
        $pdf->Cell(34	,5,$row['date'],0,1);//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //invoice contents
        $pdf->SetFont('Arial','B',12);

        $pdf->Cell(130	,5,$row['event.event_name'],1,0);
        $pdf->Cell(25	,5,$row['paymentMethodID'],1,0);
        $pdf->Cell(34	,5,$row['payment_Method'],1,1);//end of line

        $pdf->Cell(132	,5,$row['event.event_name'],1,0);
        $pdf->Cell(27	,5,$row['paymentMethodID'],1,0);
        $pdf->Cell(36	,5,$row['payment_Method'],1,1);//end of line

        $pdf->Output();  

        $this->sendMail("Invoice_tickets.pdf");
    }
}