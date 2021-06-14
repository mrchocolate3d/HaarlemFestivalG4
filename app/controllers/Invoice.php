<?php 
require "../vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;
include '../vendor/phpqrcode/qrlib.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMailWithAttachement extends Controller {

    public function index()
    {
        $this->view('Invoice/invoice');
    }
    
    public function generatePdf()
    {
        
        if (isset($_SESSION["shopping_cart"])) {
            
            $html  = '';
            $total = 0;
            $html2 = '<table border="1" style="border-collapse:collapse;">
               <tr>
               <th>Tour Date</th>
               <th>Tour Item</th>
               <th>Tour Time</th>
               <th>Tour Language</th>
               <th>Tour Guide</th>
               <th>Ticket Quantity</th>
               <th>Tour Price</th>
               ';
            
            if (is_array($_SESSION["shopping_cart"])) {
                
                foreach ($_SESSION["shopping_cart"] as $value) {
                    
                    $html .= '
                       Tour Date: ' . $value['tour_date'] . ';
                       Tour Item: ' . $value['idItem'] . ';
                       Tour Time: ' . $value['starting_time'] . ';
                       Tour Language: ' . $value['lang'] . ';
                       Tour Guide: ' . $value['tour_guide'] . ';
                       Ticket Quantity: ' . $value['quantity'] . ';
                       Tour Price: ' . $value['price'];
                    $total += $value['price'];
                    
                    $html2 .= '
                       <tr>
                       <td> ' . $value['tour_date'] . '</td>;
                       <td>' . $value['idItem'] . '</td>;
                       <td>' . $value['starting_time'] . '</td>;
                       <td>' . $value['lang'] . '</td>;
                       <td>' . $value['tour_guide'] . '</td>;
                       <td> ' . $value['quantity'] . '</td>;
                       <td> &euro; ' . $value['price'] . '</td>';
                }
                
                $html2 .= '<tr><td colspan="6">Grand Total</td><td>&euro; ' . $total . '</td></tr></table>';
                
                $fileName = md5(uniqid()) . '.jpg';
                
                $tempDir = "../public/qrfiles";
                
                $filePath = $tempDir . "/" . $fileName;
                
                QRcode::png($html, $filePath, QR_ECLEVEL_L, 4, 4);
                
                if (file_exists($filePath)) {
                    
                    $qrcode = '<img src="' . URLROOT . '/public/qrfiles/' . $fileName . '" />';
                }
                
            }
            
            $content = '<style>td,th{padding:10px}</style><div style="text-align:center"><h1>History Ticket Invoice </h1><p>Scan the Qr Code to get more details</p>' . $qrcode . $html2 . '</div>';
            
            
            $options = new Options();
            $options->set(URLROOT . '/public/qrfiles');
            $options->setIsRemoteEnabled(true);
            $dompdf = new Dompdf();
            $dompdf->setOptions($options);
            $dompdf->output();
            $dompdf->load_html($content);
            $dompdf->render();
            // $dompdf->stream("sample.pdf", array("Attachment"=>0));
            $output  = $dompdf->output();
            $pdfName = mt_rand(0, 1000000) . md5(strtotime("now"));
            $pdf     = file_put_contents($pdfName . '.pdf', $output);
            
            if ($pdf) {
                
                try {
                    $mail = new PHPMailer;
                    
                    
                    $file = '../public/' . $pdfName . '.pdf';
                    
                    $mail->setFrom  = "test@gmail.com";
                    $mail->FromName = "Haarlem Festival";
                    
                    $mail->addAddress("abhishek.narvekar80@gmail.com", "Abhishek");
                    
                    //Provide file path and name of the attachments
                    $mail->addAttachment($file);
                    
                    $mail->isHTML(true);
                    
                    $mail->Subject = "Haarlem Festival Tickets";
                    
                    echo $mail->send();
                    echo "Message has been sent successfully";
                }
                catch (Exception $e) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
            }
            
        } else {
            echo '<h3>Please add some items in the cart</h3>';
            echo '<a href="' . URLROOT . '/histories/tickets">Go to Shop</a>';
        }
    }
}