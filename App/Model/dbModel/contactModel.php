<?php
namespace Matr\Model\dbModel;

class contactModel extends tableModel
{
    protected $tablename = "contact_details";
    public function __construct()
    {
        parent::__construct();
        $this->get((object)["attributes"=>["*"]]);
    }
}
