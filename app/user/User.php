<?php 

use Ramsey\Uuid\Uuid;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class User
{
    protected $id;
    protected $fname;
    protected $lname;
    protected $email;
    protected $username;
    protected $password;
    protected $token;
    protected $uniqueId;
    protected $noAttempts;
    protected $createdDate;
    protected $lastLogin;
    protected $isVerified;

    public function __construct()
    {
        $this->noAttempts = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFname(): string|null
    {
        return $this->fname;
    }

    public function getLname(): string|null
    {
        return $this->lname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {  
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    public function getNoAttempts(): int
    {
        return $this->noAttempts;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

    public function getIsVerified()
    {
        return $this->isVerified;
    }

    public function getStatus()
    {
        if ($this->isVerified == 1) {
            return 'verified';
        } else if ($this->isVerified == 0) {
            return 'not verified';
        } else {
            return 'no';
        }
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFname(string|null $fname)
    {
        $this->fname = $fname;
    }

    public function setLname(string|null $lname)
    {
        $this->lname = $lname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function setUniqueId(string $uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    public function setNoAttempts(int $noAttempts)
    {
        $this->noAttempts = $noAttempts;
    }

    public function setCreatedDate(string $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function setLastLogin(string $lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    public function setIsVerified(bool $isVerified)
    {
        $this->isVerified = $isVerified;
    }

    public function incrementNoAttempts()
    {
        $this->noAttempts += 1;
    }

    public function generateToken()
    {
        
        $uuid = Uuid::uuid4();
        echo("Your UUID is: " . $uuid->toString() . "<br>");
        return $uuid;
    }

    public function generateUsername(string $email)
    {
        // split the email with character "@"
        // the out put for test@expample.com will be ['test', 'example.com']
        // we can use the first part to design a username
        $emailArray = explode("@", $email);

        $data = random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

        // split the string with character "-"
        // the out put for 4b8aad66-9928-4b8c-bc25-a5389c1cac7c will be ['4b8aad66', '9928', '4b8c', 'bc25', 'a5389c1cac7c']
        // we can use the first part design the username
        $uuidPart = explode("-", $uuid);

        $username = $emailArray[0] . $uuidPart[0];
        echo ("uuid: $uuid <br>");
        echo ("username: $username <br>");
        return $username;
    }

    public function generateUniqueId()
    {
        $data = random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        echo ("uuid: $uuid <br>");
        return $uuid;
    }

    public function generatePassword()
    {
        $data = random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 12 character UUID.
        // $password = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        $password = vsprintf('%s%s%s%s', str_split(bin2hex($data), 4));
        echo ("password: $password <br>");
        return $password;
    }

    public function generateHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}