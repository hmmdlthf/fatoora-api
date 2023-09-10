<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/customer/Customer.php";

class CustomerInvoiceTemp extends Db
{
    private function insertToInvoiceTemp($customerRecID)
    {
        $query = "INSERT INTO [POS].InvoiceTemporary(CustomerRecID, DBItemsPrice) OUTPUT Inserted.RecID VALUES(?, ?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerRecID, "2"]);

        $recID = $this->connect()->lastInsertId();
        $_SESSION['recID'] = $recID;

        return $recID;
    }

    private function updateCustomerInInvoiceTemp($customerRecID, $recID)
    {
        $query = "UPDATE [POS].InvoiceTemporary SET CustomerRecID = ? WHERE RecID = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerRecID, $recID]);
    }

    public function addCustomerToInvoiceTemp($customerCode, $customerPhone, $customerName, $recID)
    {
        $customerRecID = (new Customer())->find($customerCode, $customerPhone, $customerName)['RecID'];

        if ($customerRecID == "") {
            $recID = $this->insertToInvoiceTemp($customerRecID);
        } else {
            $this->updateCustomerInInvoiceTemp($customerRecID, $recID);
        }

        return json_encode(['message' => '', 'recID' => $recID]);
    }
}