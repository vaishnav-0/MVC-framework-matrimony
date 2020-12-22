<?php
namespace Matr\Model;
class contactModel{
    public $con;
    function __construct($conn)
    {
 
        $this->con = $conn;

    }
    
    public function getContact(){
        $stmp = $this->con->prepare("");
        $stmp->bind_param("issi",);
        if ($stmp->execute()){
            $this->t = $this->returnId();
        }
        else{
            return false;
        }
        $stmp->close();
        
    }

    public function addContact($mob,$mail,$landline){
        return $this->con->executeStatement('INSERT INTO contact_details (mobile_no, mail_id, landline) VALUES (?,?,?)', array($mob,$mail,$landline));
    }

    public function editContact(){
        $stmp = $this->con->prepare("");
        $stmp->bind_param("issi",);
        if ($stmp->execute()){
            $this->t = $this->returnId();
        }
        else{
            return false;
        }
        $stmp->close();
        
    }

    private function deleteContact(){
        $s = $this->con->prepare("");
        $s->bind_param("s",$this->cust_id);
        $s->execute();
		$res = $s->get_result();
        $s->close();
        $res_array = $res->fetch_assoc();
        return $res_array['#'];
        
    }

}

?>