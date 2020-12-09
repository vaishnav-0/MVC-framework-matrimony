<?php
class contactModel{
    private $cust_id;

    public $con;
    function __construct( $cust_id,$conn)
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

    public function addContact(){
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