<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/customer/Customer.php";

class CustomerInvoiceTemp extends Db
{
    public function insertToInvoiceTemp($customerRecID)
    {
        $query = "INSERT INTO [POS].InvoiceTemporary(CustomerRecID, DBItemsPrice) OUTPUT Inserted.RecID VALUES(?, ?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerRecID, "2"]);

        $recID = $this->connect()->lastInsertId();
        $_SESSION['recID'] = $recID;

        return $recID;
    }

    public function updateCustomerInInvoiceTemp($customerRecID, $recID)
    {
        $query = "UPDATE [POS].InvoiceTemporary SET CustomerRecID = ? WHERE RecID = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerRecID, $recID]);
    }

    public function addCustomerToInvoiceTemp($customerCode, $customerPhone, $customerName, $recID)
    {
        $customerRecID = (new Customer())->findByCode($customerCode, $customerPhone, $customerName)['RecID'];

        if ($customerRecID) {
            $this->updateCustomerInInvoiceTemp($customerRecID, $recID);
            return $customerRecID;
        } else {
            die('No customer with this info');
        }
    }

    public function findCustomerByInvoiceTempRecID($recID)
    {
        $query = "SELECT it.[PriceTypeRecID]
		,pt.[Name] PriceTypeName
	    ,c.[RecID]
		,c.[Code]
		,c.[Name]
		,c.[NameAR]
		,c.[Phone]
        FROM [saudipos].[POS].[InvoiceTemporary] it
        INNER JOIN [saudipos].[Business].[Customer] c ON c.[RecID] = it.[CustomerRecID]
        INNER JOIN [saudipos].[CodeMaster].[PriceType] pt ON it.[PriceTypeRecID] = pt.[RecID]
        WHERE it.[RecID] = '" . $recID . "'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}