<?php
namespace Core\data;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

class test
{
    public $result;
    public function __construct()
    {
        $con = Connection::getCon();
        $query = $con->createQueryBuilder()->addSelect('caste AS c')->from('caste_religion');
        if ($result = $query->execute()) {
            $this->result = $result->fetchAll();
        }
    }
}
