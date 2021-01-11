<?php
namespace Matr\Model;

class userModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('users');
    }
    public static function init()
    {
        $schema = new \Doctrine\DBAL\Schema\Schema();

        $userTable = $schema->createTable("users");
        $userTable->addColumn("userId", "integer", array("autoincrement" => true));
        $userTable->addColumn("username", "string", array("length" => 50));
        $userTable->addColumn("password", "string", array("length" => 50));
        $userTable->addColumn("roleId", "integer");
        $userTable->setPrimaryKey(array("userId"));
    }

    public function login($username, $password)
    {
        return $this->get(['username' => $username, 'password' => $password])->rowCount();
    }

    public function register($username, $password, $role)
    {
        return $this->add(['username' => $username, 'password' => $password, 'roleId' => $role]);
    }
}
