<?php 

class SendMail extends Controller {

    function __construct()
    {
        $this->I = $this->model('Invoice_tickets.php');
    }

    function invoice() {
        $data = [];
        $this->view('pdf_invoices/invoice', $data);
    }
    function send_mail() {
        $data = [
            'sent' => false
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'sent' => $this->I->getInvoice(0),
            ];
        }
        $this->view('pdf_invoices/invoice', $data);
    }
}