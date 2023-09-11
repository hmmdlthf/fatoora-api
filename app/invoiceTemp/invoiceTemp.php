<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class InvoiceTemp extends Db
{
    public function findById($recId)
    {
        $query = "SELECT
        [RecID]
        ,[CustomerRecID]
        ,[PriceTypeRecID]
        ,[TotalSubTotal]
        ,[TotalVATAmount]
        ,[GrandTotal]
        ,[BalanceAmount]
        FROM [saudipos].[POS].[InvoiceTemporary]
        WHERE [RecID] = '" . $recId . "'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findAllFieldsById($recId)
    {
        $query = "SELECT [RecID]
        ,[CustomerCode]
        ,[CustomerRecID]
        ,[PriceTypeRecID]
        ,[InvoiceNumber]
        ,[InvoiceDate]
        ,[PaymentTermRecID]
        ,[PaymentMethodRecID]
        ,[CashierPerson]
        ,[SalesPerson]
        ,[TotalUnitAmount]
        ,[TotalDiscountAmount]
        ,[TotalSubTotal]
        ,[TotalVATAmount]
        ,[GrandTotal]
        ,[BalanceAmount]
        ,[CardAmount]
        ,[CashAmount]
        ,[Remarks]
        ,[StatusRecID]
        ,[CreatedBranchRecID]
        ,[CreatedBy]
        ,[CreatedDate]
        ,[CreatedTime]
        ,[ModifiedBy]
        ,[ModifiedDate]
        ,[ModifiedTime]
        ,[CollectionBy]
        ,[CollectionDate]
        ,[CollectionTime]
        FROM [saudipos].[POS].[InvoiceTemporary]
        WHERE [RecID] = '" . $recId . "'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function create($username)
    {
        $query = "INSERT INTO [saudipos].[POS].[InvoiceTemporary] ([CreatedBy]) OUTPUT Inserted.RecID VALUES (?)";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount)
    {
        $query = "UPDATE [saudipos].[POS].[InvoiceTemporary]
              SET [TotalSubTotal] = ?,
                  [TotalVATAmount] = ?,
                  [GrandTotal] = ?,
                  [BalanceAmount] = ?
              WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount, $recId]);

        return $result;
    }

    public function delete($recId)
    {
        $query = "DELETE FROM [saudipos].[POS].[InvoiceTemporary] WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$recId]);

        return $result;
    }

    public function calculateTotalsAndUpdate($recId)
    {
        $invoiceDetailTemp = new InvoiceDetailTemp();

        // Calculate the new totals
        $invoiceDetailRecords = $invoiceDetailTemp->findAllByInvoiceRecID($recId); // Retrieve related InvoiceDetailTMP records
        $totalSubTotal = 0;
        $totalVATAmount = 0;
        $grandTotal = 0;
        $balanceAmount = 0;

        foreach ($invoiceDetailRecords as $record) {
            $totalSubTotal += $record['SubTotal'];
            $totalVATAmount = $record['SalesTaxAmount'];
            $grandTotal += $record['TotalAmount'];
        }

        $results = $this->updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount);

        return $results;
    }

    public function updateTotalsIncremental($recId, $totalAmountChange)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        // Incrementally update the totals
        $totalSubTotal = $existingRecord['TotalSubTotal'] + $totalAmountChange;
        // Calculate VAT amount based on your logic
        $VATAmount = $totalAmountChange * 0.15; // Assuming 15% VAT
        $totalVATAmount = $existingRecord['TotalVATAmount'] + $VATAmount;
        $grandTotal = $existingRecord['GrandTotal'] + $totalAmountChange + $VATAmount;
        $balanceAmount = $existingRecord['BalanceAmount'] + $grandTotal;

        $results = $this->updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount);

        return $results;
    }

    public function InsertInvoiceTempToInvoice($recId)
    {
        $queryInvoice = "INSERT INTO [saudipos].[POS].[Invoice] (
            [CustomerCode],
            [CustomerRecID],
            [PriceTypeRecID],
            [InvoiceNumber],
            [InvoiceDate],
            [PaymentTermRecID],
            [PaymentMethodRecID],
            [CashierPerson],
            [SalesPerson],
            [TotalUnitAmount],
            [TotalDiscountAmount],
            [TotalSubTotal],
            [TotalVATAmount],
            [GrandTotal],
            [BalanceAmount],
            [CardAmount],
            [CashAmount],
            [Remarks],
            [StatusRecID],
            [CreatedBranchRecID],
            [CreatedBy],
            [CreatedDate],
            [CreatedTime],
            [ModifiedBy],
            [ModifiedDate],
            [ModifiedTime],
            [CollectionBy],
            [CollectionDate],
            [CollectionTime]
        )
        OUTPUT Inserted.RecID
        SELECT
            [CustomerCode],
            [CustomerRecID],
            [PriceTypeRecID],
            [InvoiceNumber],
            [InvoiceDate],
            [PaymentTermRecID],
            [PaymentMethodRecID],
            [CashierPerson],
            [SalesPerson],
            [TotalUnitAmount],
            [TotalDiscountAmount],
            [TotalSubTotal],
            [TotalVATAmount],
            [GrandTotal],
            [BalanceAmount],
            [CardAmount],
            [CashAmount],
            [Remarks],
            [StatusRecID],
            [CreatedBranchRecID],
            [CreatedBy],
            [CreatedDate],
            [CreatedTime],
            [ModifiedBy],
            [ModifiedDate],
            [ModifiedTime],
            [CollectionBy],
            [CollectionDate],
            [CollectionTime]
        FROM [saudipos].[POS].[InvoiceTemporary]
        WHERE [saudipos].[POS].[InvoiceTemporary].[RecID] = '" . $recId . "'";

        $statement = $this->connect()->prepare($queryInvoice);
        $statement->execute();
        $resultSet = $statement->fetch();
        $newlyCreatedInvoiceRecID = $resultSet['RecID'];


        $queryInvoiceDetail = "INSERT INTO [saudipos].[POS].[InvoiceDetail] (
            [InvoiceRecID],
            [PriceTypeRecID],
            [ProductRecID],
            [OrderQuantity],
            [UnitAmount],
            [DiscountPercentage],
            [DiscountAmount],
            [TotalDiscountAmount],
            [SalesTaxRecID],
            [StatusRecID],
            [Reference],
            [CreatedBy],
            [CreatedDate],
            [CreatedBranchRecID],
            [ModifiedBy],
            [ModifiedDate]
        )
        SELECT
            $newlyCreatedInvoiceRecID,
            [PriceTypeRecID],
            [ProductRecID],
            [OrderQuantity],
            [UnitAmount],
            [DiscountPercentage],
            [DiscountAmount],
            [TotalDiscountAmount],
            [SalesTaxRecID],
            [StatusRecID],
            [Reference],
            [CreatedBy],
            [CreatedDate],
            [CreatedBranchRecID],
            [ModifiedBy],
            [ModifiedDate]
        FROM [saudipos].[POS].[InvoiceDetailTemporary]
        WHERE [InvoiceRecID] = '". $recId ."'";

        $statement = $this->connect()->prepare($queryInvoiceDetail);
        // $statement->bindParam(':newlyInsertedRecID', $resultSet, PDO::PARAM_INT);
        $statement->execute();

        return true;
    }

    public function InsertInvoiceTempToInvoiceHold($recId)
    {
        $queryInvoice = "INSERT INTO [saudipos].[POS].[InvoiceHold] (
            [CustomerCode],
            [CustomerRecID],
            [PriceTypeRecID],
            [InvoiceNumber],
            [InvoiceDate],
            [PaymentTermRecID],
            [PaymentMethodRecID],
            [CashierPerson],
            [SalesPerson],
            [TotalUnitAmount],
            [TotalDiscountAmount],
            [TotalSubTotal],
            [TotalVATAmount],
            [GrandTotal],
            [BalanceAmount],
            [CardAmount],
            [CashAmount],
            [Remarks],
            [StatusRecID],
            [CreatedBranchRecID],
            [CreatedBy],
            [CreatedDate],
            [CreatedTime],
            [ModifiedBy],
            [ModifiedDate],
            [ModifiedTime],
            [CollectionBy],
            [CollectionDate],
            [CollectionTime]
        )
        OUTPUT Inserted.RecID
        SELECT
            [CustomerCode],
            [CustomerRecID],
            [PriceTypeRecID],
            [InvoiceNumber],
            [InvoiceDate],
            [PaymentTermRecID],
            [PaymentMethodRecID],
            [CashierPerson],
            [SalesPerson],
            [TotalUnitAmount],
            [TotalDiscountAmount],
            [TotalSubTotal],
            [TotalVATAmount],
            [GrandTotal],
            [BalanceAmount],
            [CardAmount],
            [CashAmount],
            [Remarks],
            [StatusRecID],
            [CreatedBranchRecID],
            [CreatedBy],
            [CreatedDate],
            [CreatedTime],
            [ModifiedBy],
            [ModifiedDate],
            [ModifiedTime],
            [CollectionBy],
            [CollectionDate],
            [CollectionTime]
        FROM [saudipos].[POS].[InvoiceTemporary]
        WHERE [saudipos].[POS].[InvoiceTemporary].[RecID] = '" . $recId . "'";

        $statement = $this->connect()->prepare($queryInvoice);
        $statement->execute();
        $resultSet = $statement->fetch();
        $newlyCreatedInvoiceHoldRecID = $resultSet['RecID'];


        $queryInvoiceDetail = "INSERT INTO [saudipos].[POS].[InvoiceDetailHold] (
            [InvoiceRecID],
            [PriceTypeRecID],
            [ProductRecID],
            [OrderQuantity],
            [UnitAmount],
            [DiscountPercentage],
            [DiscountAmount],
            [TotalDiscountAmount],
            [SalesTaxRecID],
            [StatusRecID],
            [Reference],
            [CreatedBy],
            [CreatedDate],
            [CreatedBranchRecID],
            [ModifiedBy],
            [ModifiedDate]
        )
        SELECT
            $newlyCreatedInvoiceHoldRecID,
            [PriceTypeRecID],
            [ProductRecID],
            [OrderQuantity],
            [UnitAmount],
            [DiscountPercentage],
            [DiscountAmount],
            [TotalDiscountAmount],
            [SalesTaxRecID],
            [StatusRecID],
            [Reference],
            [CreatedBy],
            [CreatedDate],
            [CreatedBranchRecID],
            [ModifiedBy],
            [ModifiedDate]
        FROM [saudipos].[POS].[InvoiceDetailTemporary]
        WHERE [InvoiceRecID] = '". $recId ."'";

        $statement = $this->connect()->prepare($queryInvoiceDetail);
        // $statement->bindParam(':newlyInsertedRecID', $resultSet, PDO::PARAM_INT);
        $statement->execute();

        return true;
    }
}
