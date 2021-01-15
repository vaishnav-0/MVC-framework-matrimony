<?php
namespace Core\data;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
class addCaste
{
    public function __construct(){
        $con = Connection::getCon();
        $query = <<<QUERY
        INSERT INTO `caste_religion`(`religion`,`caste`) VALUES ("hindu","Aiyyer"),
        ("hindu","Ambalavasi"),
        ("hindu","Araya"),
        ("hindu","Brahmin"),
        ("hindu","Cheramar"),
        ("hindu","Cheruman"),
        ("hindu","Dheevara"),
        ("hindu","Embranthiri"),
        ("hindu","Ezhava"),
        ("hindu","Ezhavathy"),
        ("hindu","Ezhuthachan"),
        ("hindu","Ganaka"),
        ("hindu","Kalari Kurup"),
        ("hindu","Kalari Panicker"),
        ("hindu","Kalladi"),
        ("hindu","Kanakkan"),
        ("hindu","Kaniyan"),
        ("hindu","Kavuthiyya"),
        ("hindu","Kudumbi"),
        ("hindu","Kusava"),
        ("hindu","Mannan"),
        ("hindu","Marar"),
        ("hindu","Mukkuva"),
        ("hindu","Nadar"),
        ("hindu","Nair"),
        ("hindu","Nambeesan"),
        ("hindu","Namboodiri"),
        ("hindu","Not Specified"),
        ("hindu","Others"),
        ("hindu","Panan"),
        ("hindu","Paravan"),
        ("hindu","Paraya"),
        ("hindu","Pathiyan"),
        ("hindu","Perumannan"),
        ("hindu","Peruvannan"),
        ("hindu","Pisharody"),
        ("hindu","Potti"),
        ("hindu","Pulaya"),
        ("hindu","Pulluva"),
        ("hindu","Saliya"),
        ("hindu","Sambava"),
        ("hindu","Siddanar"),
        ("hindu","Thandan"),
        ("hindu","Thevar"),
        ("hindu","Thiyya"),
        ("hindu","Unnithan"),
        ("hindu","Valluvan"),
        ("hindu","Vanika Vysya"),
        ("hindu","Vaniyan"),
        ("hindu","Vannan"),
        ("hindu","Varma"),
        ("hindu","Veera Shyva"),
        ("hindu","Velan"),
        ("hindu","Velar"),
        ("hindu","Vellala Pillai"),
        ("hindu","Vettuva"),
        ("hindu","Vill Kurup"),
        ("hindu","Vishwakarma"),
        ("hindu","Vysya"),
        ("hindu","Warrier"),
        ("hindu","Yadhava"),
        ("hindu","Yogigurukkal")
        QUERY;
        $query = preg_replace('/\s+/', ' ', $query);

        if ($result = $con->executeQuery($query)) {
        }
    }

}
?>