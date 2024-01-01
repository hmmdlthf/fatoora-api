<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . "/fatoora/app/database/Db.php";

class FatooraInvoice extends Db
{
    protected $table = 'Fatoora.POSInvoice';
    public function findFirstRecord()
    {
        $query = "SELECT TOP 1
            RecID, 
            InvoiceNumber, 
            InvoiceHash, 
            UUID, 
            QR, 
            Stamp,
            Invoice,
            PIH
        FROM
            $this->table AS fi
        ORDER BY RecID ASC";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInvoice($invoiceNumber)
    {
        $query = "SELECT
                        RecID, 
                        InvoiceNumber, 
                        InvoiceHash, 
                        UUID, 
                        QR, 
                        Stamp,
                        Invoice,
                        PIH
                    FROM
                    $this->table AS fi
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
                        Invoice,
                        PIH
                    FROM
                    $this->table AS fi
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
        $query = "INSERT INTO $this->table 
        (InvoiceNumber, UUID, CreationStatusRecID)
        VALUES (?, ?, ?);";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber, $uuid, 0]);
        return true;
    }

    public function setInvoiceHash($invoiceNumber, $invoiceHash)
    {
        $query = "UPDATE $this->table
        SET InvoiceHash = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceHash, $invoiceNumber]);
        return true;
    }


    public function setPIH($invoiceNumber, $pih)
    {
        $query = "UPDATE $this->table
        SET PIH = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$pih, $invoiceNumber]);
        return true;
    }

    public function setInvoiceUUID($invoiceNumber, $uuid)
    {
        $query = "UPDATE $this->table
        SET UUID = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$uuid, $invoiceNumber]);
        return true;
    }

    public function setQR($invoiceNumber, $qr)
    {
        $query = "UPDATE $this->table
        SET QR = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$qr, $invoiceNumber]);
        return true;
    }

    public function setStamp($invoiceNumber, $stamp)
    {
        $query = "UPDATE $this->table
        SET Stamp = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$stamp, $invoiceNumber]);
        return true;
    }

    public function setInvoiceBase64Encoded($invoiceNumber, $invoice)
    {
        $query = "UPDATE $this->table
        SET Invoice = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoice, $invoiceNumber]);
        return true;
    }

    /**
     * Set the creation status of an invoice
     *
     * @param string $invoiceNumber The invoice number
     * @param int $status The status to set.
     * @return bool True on success, false on failure
     * 
     * Other Values 
     * 1 - Pending
     * 2 - Created
     * 3 - Reported 
     */
    public function setCreationStatus($invoiceNumber, $status = 1)
    {
        $query = "UPDATE $this->table
        SET CreationStatusRecID = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$status, $invoiceNumber]);
        return true;
    }

    /**
     * Set the reporting status of an invoice
     *
     * @param string $invoiceNumber The invoice number
     * @param int $status The status to set.
     * @return bool True on success, false on failure
     * 
     * Other Values
     * 1 - Success	
     * 2 - Failure
     */
    public function setReportingStatus($invoiceNumber, $status = 1)
    {
        $query = "UPDATE $this->table
        SET ReportingStatusRecID = ?
        WHERE InvoiceNumber = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$status, $invoiceNumber]);
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
                $this->table AS fi
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
