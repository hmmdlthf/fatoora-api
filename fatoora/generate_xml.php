<?php

use Objects\Client\ClientB2C;
use Objects\Supplier\Supplier;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . "/fatoora/login/utils.php";
require_once $ROOT . "/fatoora/app/invoice/Invoice.php";
require_once $ROOT . "/fatoora/app/customer/Customer.php";
require_once $ROOT . "/fatoora/app/invoiceDetail/InvoiceDetail.php";
require_once $ROOT . "/fatoora/app/fatoora/FatooraInvoice.php";
require_once $ROOT . "/fatoora/fatoora/utils.php";
require_once $ROOT . "/fatoora/fatoora/csr-config.php";
require_once $ROOT . "/fatoora/app/fatoora/objects/Supplier.php";
require_once $ROOT . "/fatoora/app/fatoora/objects/ClientB2C.php";

session_start();

$invoiceNumber = $_GET['invoiceNumber'];
$invoiceTypeName = $_GET['invoiceType'] ?? 'Simplified'; // Invoice / Simplified
$invoice = (new Invoice())->findInvoiceHeaderFooterByInvoiceNumber($invoiceNumber);

$invoiceRecID = $invoice['RecID'];
$invoiceNumber = $invoice['InvoiceNumber'];
$date =  $invoice['DATE'];
$deliveryDate =  $invoice['DeliveryDate'];
$time =  $invoice['TIME'];
$cash =  $invoice['CashAmount'];
$card =  $invoice['CardAmount'];
$balance =  $invoice['BalanceAmount'];
$subTotal =  $invoice['TotalSubTotal'];
$totalVAT =  $invoice['TotalVATAmount'];
$grandTotal =  $invoice['GrandTotal'];
$customerCode = $invoice['CustomerCode'];
$customerName =  $invoice['CustomerName'];
$customerNameAR =  $invoice['CustomerNameAR'];
$customerVAT =  $invoice['VATNumber'];
$remarks =  $invoice['Remarks'];

$fatooraInvoice = new FatooraInvoice();
$firstRecord = $fatooraInvoice->findFirstRecord();
$fatooraInvoiceDocument = $fatooraInvoice->findOrCreateInvoice($invoiceNumber);
$invoiceCounter = extractCounter($invoiceNumber);

if ($firstRecord == false) {
    $PIH = 'NWZlY2ViNjZmZmM4NmYzOGQ5NTI3ODZjNmQ2OTZjNzljMmRiYzIzOWRkNGU5MWI0NjcyOWQ3M2EyN2ZiNTdlOQ==';
} else {
    $invoiceNumberPrevious = getInvoiceNumberFromCounter((int)$invoiceCounter - 1);
    $fatooraInvoicePrevious = $fatooraInvoice->findInvoice($invoiceNumberPrevious);
    $PIH = $fatooraInvoicePrevious['InvoiceHash'];
}

$fatooraInvoice->setPIH($invoiceNumber, $PIH);
$uuid = $fatooraInvoiceDocument['UUID'];
// $customerIdentificationTypeCode = 'CRN';
$customerIdentificationTypeCode = 'NAT';

$invoiceDetailRecords = (new InvoiceDetail())->findAllByInvoiceRecID($invoiceRecID);

// generating xml
// SignatureInformation
$sign = (new \Saleh7\Zatca\SignatureInformation)
    ->setReferencedSignatureID("urn:oasis:names:specification:ubl:signature:Invoice")
    ->setID('urn:oasis:names:specification:ubl:signature:1');

// UBLDocumentSignatures
$ublDecoment = (new \Saleh7\Zatca\UBLDocumentSignatures)
    ->setSignatureInformation($sign);

$extensionContent = (new \Saleh7\Zatca\ExtensionContent)
    ->setUBLDocumentSignatures($ublDecoment);

// UBLExtension
$UBLExtension[] = (new \Saleh7\Zatca\UBLExtension)
    ->setExtensionURI('urn:oasis:names:specification:ubl:dsig:enveloped:xades')
    ->setExtensionContent($extensionContent);

$UBLExtensions = (new \Saleh7\Zatca\UBLExtensions)
    ->setUBLExtensions($UBLExtension);

$signature = (new \Saleh7\Zatca\Signature)
    ->setId("urn:oasis:names:specification:ubl:signature:Invoice")
    ->setSignatureMethod("urn:oasis:names:specification:ubl:dsig:enveloped:xades");
// invoiceType object
$invoiceType = (new \Saleh7\Zatca\InvoiceType())
    ->setInvoice($invoiceTypeName) // Invoice / Simplified
    ->setInvoiceType('Invoice'); // Invoice / Debit / Credit
// invoiceType object
$inType = (new \Saleh7\Zatca\BillingReference())
    ->setId('Invoice');

// invoiceType object
$contact = (new \Saleh7\Zatca\Contract())
    ->setId('15');


$additionalDocumentReferences = [];

$additionalDocumentReferences[] = (new \Saleh7\Zatca\AdditionalDocumentReference())
    ->setId('ICV')
    ->setUUID($invoiceCounter);

$additionalDocumentReferences[] = (new \Saleh7\Zatca\AdditionalDocumentReference())
    ->setId('PIH')
    ->setPreviousInvoiceHash($PIH);

// $additionalDocumentReferences[] = (new \Saleh7\Zatca\AdditionalDocumentReference())
//     ->setId('QR');




$customerDetails = (new Customer())->findCustomerDetails($customerCode);
$customerRegistrationNumber = $customerVAT;
$customerStreetName = !empty($customerDetails['StreetName']) ? $customerDetails['StreetName'] : (!empty($customerDetails['AddressLine']) ? $customerDetails['AddressLine'] : null);
$customerBuildingNumber = !empty($customerDetails['BuildingNumber']) ? $customerDetails['BuildingNumber'] : null;
$customerCityName = !empty($customerDetails['CityName']) ? $customerDetails['CityName'] : null;
$customerCountryCode = !empty(str_replace(' ', '', $customerDetails['CountryCode'])) ? str_replace(' ', '', $customerDetails['CountryCode']) : null;
$customerPostalCode = !empty(str_replace(' ', '', $customerDetails['POBox'])) ? str_replace(' ', '', $customerDetails['POBox']) : null;


// Tax scheme
$taxScheme = (new \Saleh7\Zatca\TaxScheme())
    ->setId("VAT");


$supplier = new Supplier(
    $taxScheme,
    $supplierName,
    $supplierVAT,
    $supplierVAT,
    $supplierIdentificationTypeCode,
    $supplierStreetName,
    $supplierBuildingNumber,
    $supplierBuildingNumber,
    $supplierCityName,
    $supplierCityName,
    $supplierPostalCode,
    $supplierCountryCode
);

$client = new ClientB2C(
    $taxScheme, 
    $customerName, 
    $customerVAT, 
    $customerRegistrationNumber, 
    $customerIdentificationTypeCode, 
    $customerStreetName, 
    $customerBuildingNumber, 
    $customerBuildingNumber, 
    $customerCityName, 
    $customerCityName, 
    $customerPostalCode, 
    $customerCountryCode
);


$delivery = (new \Saleh7\Zatca\Delivery())
    ->setActualDeliveryDate($deliveryDate);

$clientPaymentMeans = (new \Saleh7\Zatca\PaymentMeans())
    ->setPaymentMeansCode("10");

$taxCategory = (new \Saleh7\Zatca\TaxCategory())
    ->setPercent(15)
    ->setTaxScheme($taxScheme);


// Allowance charges
$allowanceCharges = [];
$allowanceCharges[] = (new \Saleh7\Zatca\AllowanceCharge())
    ->setChargeIndicator(false)
    ->setAllowanceChargeReason('discount')
    ->setAmount(0.00)
    ->setTaxCategory($taxCategory);


if ($grandTotal != $subTotal + $totalVAT) {
    die400('Main Invoice Total Calculation Are Wrong');
}


// tax total
$taxSubTotal = (new \Saleh7\Zatca\TaxSubTotal())
    ->setTaxableAmount($subTotal)
    ->setTaxAmount($totalVAT)
    ->setTaxCategory($taxCategory);

$taxTotal = (new \Saleh7\Zatca\TaxTotal())
    ->addTaxSubTotal($taxSubTotal)
    ->setTaxAmount($totalVAT);

$legalMonetaryTotal = (new \Saleh7\Zatca\LegalMonetaryTotal())
    ->setLineExtensionAmount($subTotal)
    ->setTaxExclusiveAmount($subTotal)
    ->setTaxInclusiveAmount($grandTotal)
    ->setPrepaidAmount(0)
    ->setPayableAmount($grandTotal)
    ->setAllowanceTotalAmount(0);

$classifiedTax = (new \Saleh7\Zatca\ClassifiedTaxCategory())
    ->setPercent(15)
    ->setTaxScheme($taxScheme);


// Invoice Line(s)
$invoiceLines = [];
foreach ($invoiceDetailRecords as $invoiceDetailRecord) {
    $salesTaxAmount = $invoiceDetailRecord['SalesTaxAmount'];
    $unitAmount = $invoiceDetailRecord['UnitAmount'];
    $totalAmount = $invoiceDetailRecord['TotalAmount'];
    $productFullName = $invoiceDetailRecord['ProductFullName'];
    $productRecID = $invoiceDetailRecord['ProductRecID'];
    $subTotal = $invoiceDetailRecord['SubTotal'];
    $orderQuantity = $invoiceDetailRecord['OrderQuantity'];

    if ($subTotal != $unitAmount * $orderQuantity) {
        die400("Invoice Line for ProductRecID $productRecID - SubTotal Calculation Is Wrong");
    }

    if ($totalAmount != $subTotal + $salesTaxAmount) {
        die400("Invoice Line for ProductRecID $productRecID - Total Calculation Are Wrong");
    }

    // Invoice Line tax totals
    $lineTaxTotal = (new \Saleh7\Zatca\TaxTotal())
        ->setTaxAmount($salesTaxAmount)
        ->setRoundingAmount($totalAmount);
    // Product
    $productItem = (new \Saleh7\Zatca\Item())
        ->setName($productFullName)
        ->setClassifiedTaxCategory($classifiedTax);
    // Price
    $price = (new \Saleh7\Zatca\Price())
        ->setUnitCode(\Saleh7\Zatca\UnitCode::UNIT)
        ->setPriceAmount($unitAmount);
    $invoiceLines[] = (new \Saleh7\Zatca\InvoiceLine())
        ->setUnitCode("PCE")
        ->setId($productRecID)
        ->setItem($productItem)
        ->setLineExtensionAmount($subTotal)
        ->setPrice($price)
        ->setTaxTotal($lineTaxTotal)
        ->setInvoicedQuantity($orderQuantity);
}



// Invoice object
$invoice = (new \Saleh7\Zatca\Invoice())
    // ->setUBLExtensions($UBLExtensions)
    ->setUUID($uuid)
    ->setId($invoiceNumber)
    ->setIssueDate(new \DateTime())
    ->setIssueTime(new \DateTime())
    ->setInvoiceType($invoiceType)
    // ->Signature($signature)
    ->setContract($contact)
    // ->setBillingReference($inType)
    ->setAdditionalDocumentReferences($additionalDocumentReferences)
    ->setDelivery($delivery)
    ->setAllowanceCharges($allowanceCharges)
    ->setPaymentMeans($clientPaymentMeans)
    ->setTaxTotal($taxTotal)
    ->setInvoiceLines($invoiceLines)
    ->setLegalMonetaryTotal($legalMonetaryTotal)
    ->setAccountingCustomerParty($client)
    ->setAccountingSupplierParty($supplier);


$generatorXml = new \Saleh7\Zatca\GeneratorInvoice();
$outputXML = $generatorXml->invoice($invoice);
$encodedInvoice = encodeXMLtoBase64($outputXML);
$fatooraInvoice->setInvoiceBase64Encoded($invoiceNumber, $encodedInvoice);
$fatooraInvoice->setCreationStatus($invoiceNumber, 2); // status created


$filePath = 'xml-files/generated-simplified-xml-invoice.xml';
file_put_contents($filePath, $outputXML);




