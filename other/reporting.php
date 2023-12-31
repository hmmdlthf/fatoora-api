<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . '/fatoora/fatoora/csr-config.php';
require_once $ROOT . "/fatoora/app/invoice/Invoice.php";
require_once $ROOT . "/fatoora/app/invoiceDetail/InvoiceDetail.php";
require_once $ROOT . '/fatoora/app/fatoora/FatooraSettings.php';
require_once $ROOT . '/fatoora/app/fatoora/FatooraInvoice.php';
require_once $ROOT . "/fatoora/fatoora/utils.php";

use Bl\FatooraZatca;
use Bl\FatooraZatca\Objects\Client;
use Bl\FatooraZatca\Objects\Invoice as InvoiceXML;
use Bl\FatooraZatca\Objects\Seller;
use Bl\FatooraZatca\Objects\Setting;
use Bl\FatooraZatca\Objects\InvoiceItem;
use Bl\FatooraZatca\Services\ReportInvoiceService;
use Bl\FatooraZatca\Zatca;

$zatca = new Zatca();

$settings = (new FatooraSettings())->findSettings();
$seller = new Seller(
    $supplierVAT, $supplierStreetName, $supplierBuildingNumber, $supplierBuildingNumber, $supplierCityName, $supplierCityName, 
    $supplierPostalCode, $supplierVAT, $supplierName, $settings['private_key'], $settings['cert_production'], $settings['secret_production']);

$invoiceNumber = $_GET['invoiceNumber'];
$invoice = (new Invoice())->findInvoiceHeaderFooterByInvoiceNumber($invoiceNumber);

$invoiceRecID = $invoice['RecID'];
$invoiceNumber = $invoice['InvoiceNumber'];
// $uuid = '22933a7e-2e60-4aa3-9e2e-efbacea502ff';
$date =  $invoice['DATE'];
$deliveryDate =  $invoice['DeliveryDate'] ?? $date;
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

$fatooraInvoiceDocument = (new FatooraInvoice())->findOrCreateInvoice($invoiceNumber);

$PIH = $fatooraInvoiceDocument['PIH'];
$isPIH = empty($PIH) == true ? false : true;
// $PIH = 'nzPSlf+bp71zze+fD6g+yuTJs249l4ArEVVtwxSImT4=';
$invoiceCounter = extractCounter($invoiceNumber);
$uuid = $fatooraInvoiceDocument['UUID'];

$invoiceDetailRecords = (new InvoiceDetail())->findAllByInvoiceRecID($invoiceRecID);

$invoiceItems = [];
foreach ($invoiceDetailRecords as $invoiceDetailRecord) {
    $invoiceItem = new InvoiceItem(
        $invoiceDetailRecord['RecordNumber'], $invoiceDetailRecord['ProductFullName'], $invoiceDetailRecord['OrderQuantity'], 
        $invoiceDetailRecord['UnitAmount'], 0, $invoiceDetailRecord['SalesTaxAmount'], 15, $invoiceDetailRecord['TotalAmount']);
    $invoiceItems[] = $invoiceItem;
}

$invoiceHash = $PIH;
$invoice = new InvoiceXML($invoiceRecID, $invoiceNumber, $uuid, $date, $time, 388, 10, $subTotal, 0, $totalVAT, $grandTotal, $invoiceItems, $invoiceHash, delivery_date:$deliveryDate);
$response = (new ReportInvoiceService($seller, $invoice, null))->reporting();

$fatooraInvoice = new FatooraInvoice();
$fatooraInvoice->setInvoiceHash($invoiceNumber, $response['invoiceHash']);
$fatooraInvoice->setInvoiceUUID($invoiceNumber, $invoice->invoice_uuid);
$fatooraInvoice->setInvoiceBase64Encoded($invoiceNumber, $response['clearedInvoice']);

$filePath = '../fatoora/xml-files/generated-simplified-xml-invoice-2.xml';
file_put_contents($filePath, base64_decode($response['clearedInvoice']));

var_dump($response);
// echo '\n\n';
// echo 'Reporting Done';
