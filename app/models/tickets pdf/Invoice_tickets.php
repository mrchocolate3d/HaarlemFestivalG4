<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
        $this->db->singleRow();
        
        return $query;
    }

    public function sendMail($path) {
        $mail = new PHPMailer(true);
        try {
                
                
                $mail = new PHPMailer(true);
                
                 //Server settings
                 $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                 // sending the mail using smtp                      
                 $mail->isSMTP(); 
                 //Set the SMTP server on the host website to send through                                          
                 $mail->Host       = 'smtp.example.com';                     
                 $mail->SMTPAuth   = true;                               
                 $mail->Username   = 'abhishek.narvekar80@gmail.com';                  
                 $mail->Password   = '@Mx8g$E3';                            
                 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                 $mail->Port       = 587;                                   
                
                $mail->SetFrom("abhishek.narvekar80@gmail.com","Company");
                $mail->AddAddress("abhishek.narvekar90@gmail.com");
                $mail->Subject  = "Invoice of tickets for haalrem festival";      
                $body = "Please find your pdf ticket attachements for the haarlem festivals \n";
                $mail->Body = $body;
                
                
                $mail->AddAttachment('test.pdf', 'test.pdf');
                if(!$mail->Send()) {
                    
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                    echo "Invoice was sent";
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
        $pdf->Cell(25	,5,$row['paymentMethodID'],1, 0);
        $pdf->Cell(34	,5,$row['payment_Method'], 1, 1);//end of line

        $pdf->Cell(132	,5,$row['event.event_name'],1,0);
        $pdf->Cell(27	,5,$row['paymentMethodID'],1,0);
        $pdf->Cell(36	,5,$row['payment_Method'],1,1);//end of line

        $pdf->Output();  

        $this->sendMail("Invoice_tickets.pdf");
    }
}