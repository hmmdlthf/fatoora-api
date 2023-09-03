<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/admin/AdminRepository.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/email/Email.php';

class AdminService
{
    private $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    public function getAdminById(int $adminId)
    {
        return $this->adminRepository->findAdminById($adminId);
    }

    public function getAdminByEmail(string $email)
    {
        return $this->adminRepository->findAdminByEmail($email);
    }

    public function getAdminByUsername(string $username)
    {
        return $this->adminRepository->findAdminByUsername($username);
    }

    public function getAdmins()
    {
        return $this->adminRepository->findAdmins();
    }

    public function sendCreationEmail(Admin $admin, $password)
    {
        $body = "Your login credentials. <br><br>".
                "Credentials requested email: ". $admin->getEmail() . "<br>".
                "username: " . $admin->getUsername() . "<br>".
                "password: " . $password . "<br>".
                "created at: " . $admin->getCreatedDate() . "<br>".
                "click the link to verify <br>".
                "http://" . $_SERVER['HTTP_HOST'] . "/admin/verify.php?email=". $admin->getEmail() . "&token=" . $admin->getToken() . "<br>"
        ;

        try {
            $email = new Email();
            $email->setTo($admin->getEmail());
            $email->setSubject('Welcome to Online Academy');
            $email->setIsHTML(true);
            $email->setBody($body);
            $email->setAltBody("we sent the email in html, it seems your mail server doesn't support html");
            $email->setSendersName("Online Academy");
            $email->sendEmail();
        } catch (Exception $e) {
            die("error $e");
        }

        
    }

    public function save($email)
    {
        if ($this->getAdminByEmail($email) !== false) {
            echo ("admin already exists");
            return false;
        }   
        $admin = new Admin();
        $admin->setEmail($email);
        $admin->setToken($admin->generateToken());
        $admin->setUsername($admin->generateUsername($email));
        $password = $admin->generatePassword();
        $admin->setPassword($admin->generateHash($password));
        $admin->setUniqueId($admin->generateUniqueId());
        $admin->setNoAttempts(0);
        $admin->setCreatedDate(date("Y-m-d H:i:s"));
        $admin->setLastLogin(date("Y-m-d H:i:s"));
        $admin->setIsVerified(false);
        $this->adminRepository->save($admin);
        $this->sendCreationEmail($admin, $password);
    }

    public function update($id, $fname, $lname)
    {
        $admin = $this->getAdminById($id);
        if ($admin == false) {
            echo ("admin not found");
            return false;
        }
        $admin->setFname($fname);
        $admin->setLname($lname);
        $this->adminRepository->update($admin);
    }

    public function delete($id)
    {
        $admin = $this->getAdminById($id);
        if ($admin == false) {
            echo ("admin not found");
            return false;
        }
        $this->adminRepository->delete($admin);
    }

    public function sendVerifiedEmail(Admin $admin)
    {
        $body = "Your email ". $admin->getEmail() ." verified successfully <br><br>";

        try {
            $email = new Email();
            $email->setTo($admin->getEmail());
            $email->setSubject('Verify Success');
            $email->setIsHTML(true);
            $email->setBody($body);
            $email->setAltBody("we sent the email in html, it seems your mail server doesn't support html");
            $email->setSendersName("Online Academy");
            $email->sendEmail();
        } catch (Exception $e) {
            die("error $e");
        }
    }

    public function verify($email, $token)
    {
        $admin = $this->getAdminByEmail($email);

        if ($admin->getIsVerified() == 1) {
            die('link already used');
            return true;
        } 

        if ($admin->getToken() == $token) {
            $admin->setIsVerified(true);
            $this->adminRepository->verify($admin);
            $this->sendVerifiedEmail($admin);
        } else {
            die("invalid link");
        }
    }

    public function updateLogin(Admin $admin)
    {
        $this->adminRepository->updateLastLogin($admin);
    }

    public function verifyPassword($username, $password)
    {
        $admin = $this->getAdminByUsername($username);
        echo $admin->getPassword() . "<br>";

        if (password_verify($password, $admin->getPassword())) {
            $admin->setLastLogin(date("Y-m-d H:i:s"));
            $this->updateLogin($admin);
            return true;
        } else {
            echo ("password doesn't match <br>");
            return false;
        }
    }

    
}