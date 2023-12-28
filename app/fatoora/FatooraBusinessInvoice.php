<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . "/fatoora/app/database/Db.php";

class FatooraBusinessInvoice extends Db
{
    public function findInvoice($invoiceNumber)
    {
        $query = "SELECT
                        RecID, 
                        InvoiceNumber, 
                        InvoiceHash, 
                        UUID, 
                        QR, 
                        Stamp,
                        Invoice
                    FROM
                        Fatoora.BusinessInvoice AS fi
                    WHERE
                        InvoiceNumber = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInvoiceByRecID($recID)
    {
        $query = "SELECT
                        RecID, 
                        InvoiceNumber, 
                        InvoiceHash, 
                        UUID, 
                        QR, 
                        Stamp,
                        Invoice
                    FROM
                        Fatoora.BusinessInvoice AS fi
                    WHERE
                        RecID = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$recID]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }


    public function createInvoice($invoiceNumber)
    {
        $uuid = generateUUID();
        $query = "INSERT INTO Fatoora.BusinessInvoice 
        (InvoiceNumber, UUID)
        VALUES (?, ?);";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber, $uuid]);
        return true;
    }

    public function setInvoiceHash($invoiceNumber, $invoiceHash)
    {
        $query = "UPDATE Fatoora.BusinessInvoice
        SET InvoiceHash = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceHash, $invoiceNumber]);
        return true;
    }

    public function setInvoiceUUID($invoiceNumber, $uuid)
    {
        $query = "UPDATE Fatoora.BusinessInvoice
        SET UUID = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$uuid, $invoiceNumber]);
        return true;
    }

    public function setQR($invoiceNumber, $qr)
    {
        $query = "UPDATE Fatoora.BusinessInvoice
        SET QR = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$qr, $invoiceNumber]);
        return true;
    }

    public function setStamp($invoiceNumber, $stamp)
    {
        $query = "UPDATE Fatoora.BusinessInvoice
        SET Stamp = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$stamp, $invoiceNumber]);
        return true;
    }

    public function setInvoiceBase64Encoded($invoiceNumber, $invoice)
    {
        $query = "UPDATE Fatoora.BusinessInvoice
        SET Invoice = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoice, $invoiceNumber]);
        return true;
    }

    public function findOrCreateInvoice($invoiceNumber)
    {
        $query = "SELECT
                    RecID, 
                    InvoiceNumber, 
                    InvoiceHash,
                    PIH, 
                    UUID, 
                    QR, 
                    Stamp
                FROM
                    Fatoora.BusinessInvoice AS fi
                WHERE
                    InvoiceNumber = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber]);
        $resultSet = $statement->fetch();

        if ($resultSet) {
            return $resultSet;
        } else {
            // If the invoice doesn't exist, create a new record
            $this->createInvoice($invoiceNumber);
            return $this->findInvoice($invoiceNumber);
        }
    }
}
