<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/user/UserRepository.php';

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function getUserById(int $userId)
    {
        return $this->userRepository->findUserById($userId);
    }

    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function getUsers()
    {
        return $this->userRepository->findUsers();
    }

    public function save($email)
    {
        if ($this->getUserByEmail($email) !== false) {
            echo ("user already exists");
            return false;
        }   
        $user = new User();
        $user->setEmail($email);
        $this->userRepository->save($user);
    }

    public function update($id, $email)
    {
        $user = $this->getUserById($id);
        if ($user == false) {
            echo ("user not found");
            return false;
        }
        $user->setEmail($email);
        $this->userRepository->update($user);
    }

    public function delete($id)
    {
        $user = $this->getUserById($id);
        if ($user == false) {
            echo ("user not found");
            return false;
        }
        $this->userRepository->delete($user);
    }
}