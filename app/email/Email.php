<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/email/SendMail.php";


class Email extends Db
{
    use SendMail;

    private $date;


    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function sendEmail(): bool
    {
        $this->configEmail();
        try {
            $this->mail->send();
            echo "Email sent successfuly <br>";
            $this->emailSentStatus = true;
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error {$e} : {$this->mail->ErrorInfo} <br>";
            $this->emailSentStatus = false;
        }

        try {
            $this->saveEmail();
            echo "Email saved successfully <br>";
        } catch (Exception $e) {
            echo "Email could not be saved. $e <br>";
        }

        return $this->emailSentStatus;
    }

    public function saveEmail()
    {
        $query = "INSERT INTO `emails` (`from`, `to`, `subject`, `body`, `date`) VALUES ( ?, ?, ?, ?, ? )";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$this->sendersEmail, $this->to, $this->subject, $this->body, date("Y-m-d H:i:s")]);
    }

    public function getEmails()
    {
        $query = "SELECT * FROM `emails` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $rows = count($resultSet);

        if ($rows > 0) {
            return $resultSet;
        }
    }
}