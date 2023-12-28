<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . '/fatoora/app/fatoora/FatooraApi.php';
require_once $ROOT . '/fatoora/app/fatoora/FatooraSdk.php';

try {
    if (isset($_GET['invoiceNumber']) || isset($_GET['invoiceType'])) {
        $invoiceNumber = $_GET['invoiceNumber'];

        // generate the csr properties file
        include_once $ROOT . '/fatoora/fatoora/generate_xml.php';

        // sign the invoice
        // generate invoice hash
        $fatooraCommand = new FatooraCommandExecutor();
        $output = $fatooraCommand->signAndGenerateInvoiceHash($fatooraCommand->xmlFilePath . '/generated-xml-invoice.xml');
        $hash = $fatooraCommand->extractInvoiceHash($output);
        $fatooraCommand->printArrayLineByLine($output);
        echo '<br>';

        // create api request json file
        $output = $fatooraCommand->generateJsonApiRequest($fatooraCommand->xmlFilePath . '/generated-xml-invoice_signed.xml', $fatooraCommand->fileRootPath . '/api-request.json');
        $fatooraCommand->printArrayLineByLine($output);
        echo '<br>';

        // save hash to database
        $fatooraInvoice = new FatooraInvoice();
        $response = $fatooraInvoice->setInvoiceHash($invoiceNumber, $hash);

        // run the compliance invoice api
        $fatooraApi = new ReportingAPI($invoiceNumber);
        $response = $fatooraApi->postRequest();
        echo $response;
    }
} catch (Exception $e) {
    echo $e;
}
