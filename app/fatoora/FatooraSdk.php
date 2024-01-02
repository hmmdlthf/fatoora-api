<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/fatoora/vendor/autoload.php';
require_once $ROOT . '/fatoora/app/fatoora/FatooraBusinessInvoice.php';
require_once $ROOT . '/fatoora/app/fatoora/FatooraInvoice.php';

/**
 * Fatoora Command
 * 
 * ```
 * @ $result = FatooraCommandExecutor::generateCSR('csrConfigFile', 'privateKeyFile', 'generatedCsrFile');
 * var_dump($result);
 * ```
 * 
 */
class FatooraCommandExecutor
{
    public $fileRootPath;
    public $xmlFilePath;
    public $sdkPath;
    public $generatedCsr;
    public $privateKey;
    public $csrConfig;
    public $command;

    public function __construct()
    {
        $ROOT = $_SERVER["DOCUMENT_ROOT"];
        $this->fileRootPath = $ROOT . '/fatoora/fatoora';
        $this->xmlFilePath = $ROOT . '/fatoora/fatoora/xml-files';
        $this->generatedCsr = $ROOT . '/fatoora/fatoora/generated-csr.csr';
        $this->privateKey = $ROOT . '/fatoora/fatoora/generated-private-key.key';
        $this->csrConfig = $ROOT . '/fatoora/fatoora/csr-config-EN.properties';
    }

    public function setSdkPath($path)
    {
        $this->sdkPath = 'C:\zatca-einvoicing-sdk';
    }

    public function executeCommand($command)
    {
        $output = [];
        exec($command, $output);
        return $output;
    }

    public function printArrayLineByLine($array)
    {
        echo $this->command . '<br><br>';
        foreach ($array as $line) {
            echo $line . '<br>';
        }
    }

    public function generateCSR()
    {
        $this->command = "fatoora -csr -csrConfig $this->csrConfig -privateKey $this->privateKey -generatedCsr $this->generatedCsr";
        return self::executeCommand($this->command);
    }

    public function signAndGenerateInvoiceHash($invoiceFile)
    {
        $invoiceFileName = pathinfo($invoiceFile, PATHINFO_FILENAME); // Extract file name without extension
        $directoryPath = dirname($invoiceFile);
        $signedInvoice = $directoryPath . '/' . $invoiceFileName . '_signed.xml'; // Construct the signed invoice file name
        
        $this->command = "fatoora -sign -invoice $invoiceFile -signedInvoice $signedInvoice";
        return self::executeCommand($this->command);
    }

    public function generateJsonApiRequest($invoiceFile, $apiRequest)
    {
        $this->command = "fatoora -invoice $invoiceFile -invoiceRequest -apiRequest $apiRequest";
        return self::executeCommand($this->command);
    }

    public function generateQRCode($invoiceFile)
    {
        $this->command = "fatoora -qr -invoice $invoiceFile";
        return self::executeCommand($this->command);
    }

    public function validateInvoice($invoiceFile)
    {
        $this->command = "fatoora -validate -invoice $invoiceFile";
        return self::executeCommand($this->command);
    }

    public function generateInvoiceHash($invoiceFile)
    {
        $this->command = "fatoora -generateHash -invoice $invoiceFile";
        return self::executeCommand($this->command);
    }

    public function getFilePath($directory, $filename)
    {
        // Constructing the file path
        $filePath = rtrim($directory, '/') . '/' . ltrim($filename, '/');

        // Checking if the file exists
        if (file_exists($filePath)) {
            return $filePath;
        } else {
            return "File not found at: $filePath";
        }
    }

    public static function getFileContents($filePath)
    {
        // Checking if the file exists
        if (file_exists($filePath)) {
            // Read the file contents
            $fileContents = file_get_contents($filePath);
            return $fileContents;
        } else {
            return "File not found at: $filePath";
        }
    }

    public static function extractInvoiceHash($outputArray)
    {
        $pattern = '/\*\*\* INVOICE HASH = (.+)$/';
        foreach ($outputArray as $line) {
            if (preg_match($pattern, $line, $matches)) {
                return $matches[1]; // Extracted hash
            }
        }
        return null; // Return null if not found
    }

    public function saveInvoiceDetaisFromApiRequestJson($invoiceNumber, $invoiceType = 'pos')
    {
        $apiRequest = self::getFileContents($this->fileRootPath. '/api-request.json');
        $apiRequestArray = json_decode($apiRequest, true);
        $fatooraInvoice = $invoiceType == 'pos' ? new FatooraInvoice() : new FatooraBusinessInvoice();
        $fatooraInvoice->setInvoiceHash($invoiceNumber, $apiRequestArray['invoiceHash']);
        $fatooraInvoice->setInvoiceUUID($invoiceNumber, $apiRequestArray['uuid']);
        $fatooraInvoice->setInvoiceBase64Encoded($invoiceNumber, $apiRequestArray['invoice']);
        return true;
    }
}
