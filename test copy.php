<?php
namespace Core\data;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

class test
{
    public $result;
    public function __construct()
    {
        $con = Connection::getCon();
        $query = $con->createQueryBuilder()->Select('member.*, re')->from('caste_religion');
        if ($result = $query->execute()) {
            $this->result = $result->fetchAll();
        }
    }
}
SELECT members.id,members.join_date,members.name,members.dob,members.height,members.physique,members.gender,members.occupation,members.qualification,members.photo,members.complexion,members.star,members.horoscope,caste_religion.religion,caste_religion.caste,contact_details.mobile_no,contact_details.mail_id,contact_details.landline,address.address,address.city,address.district,address.pin,address.landmark,family.fName AS father,family.mName AS mother,family.fOcc,family.mOcc FROM `members` LEFT JOIN caste_religion ON caste_religion.caste_id = members.caste_rel_id LEFT JOIN contact_details on members.contact_id = contact_details.contact_id LEFT JOIN address ON members.a_id = address.a_id LEFT JOIN family ON members.family_id = family.pId

SELECT members.id,members.join_date,members.name,members.dob,members.height,members.physique,members.gender,members.occupation,members.qualification,members.photo,members.complexion,members.star,members.horoscope,caste_religion.religion,caste_religion.caste,contact_details.mobile_no,contact_details.mail_id,contact_details.landline,address.address,address.city,address.district,address.pin,address.landmark,family.fName AS father,family.fOcc,Fcon.F_mobile,Fcon.F_mail,Fcon.F_landline,family.mName AS mother,family.mOcc FROM `members` LEFT JOIN caste_religion ON caste_religion.caste_id = members.caste_rel_id LEFT JOIN contact_details on members.contact_id = contact_details.contact_id LEFT JOIN address ON members.a_id = address.a_id LEFT JOIN family ON members.family_id = family.pId LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS F_mobile,contact_details.mail_id AS F_mail,contact_details.landline AS F_landline FROM family LEFT JOIN contact_details ON family.fCId = contact_details.contact_id) Fcon ON Fcon.pId = members.family_id

SELECT members.id,members.join_date,members.name,members.dob,members.height,members.physique,members.gender,members.occupation,members.qualification,members.photo,members.complexion,members.star,members.horoscope,caste_religion.religion,caste_religion.caste,contact_details.mobile_no,contact_details.mail_id,contact_details.landline,address.address,address.city,address.district,address.pin,address.landmark,family.fName AS father,family.fOcc,Fcon.F_mobile,Fcon.F_mail,Fcon.F_landline,family.mName AS mother,family.mOcc,Mcon.M_mobile,Mcon.M_mail,Mcon.M_landline FROM `members` LEFT JOIN caste_religion ON caste_religion.caste_id = members.caste_rel_id LEFT JOIN contact_details on members.contact_id = contact_details.contact_id LEFT JOIN address ON members.a_id = address.a_id LEFT JOIN family ON members.family_id = family.pId LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS F_mobile,contact_details.mail_id AS F_mail,contact_details.landline AS F_landline FROM family LEFT JOIN contact_details ON family.fCId = contact_details.contact_id) Fcon ON Fcon.pId = members.family_id LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS M_mobile,contact_details.mail_id AS M_mail,contact_details.landline AS M_landline FROM family LEFT JOIN contact_details ON family.mCId = contact_details.contact_id) Mcon ON Mcon.pId = members.family_id

SELECT members.id,members.join_date,members.name,members.dob,members.height,members.physique,members.gender,members.occupation,members.qualification,members.photo,members.complexion,members.star,members.horoscope,caste_religion.religion,caste_religion.caste,contact_details.mobile_no,contact_details.mail_id,contact_details.landline,address.address,address.city,address.district,address.pin,address.landmark,family.fName AS father,family.fOcc,Fcon.F_mobile,Fcon.F_mail,Fcon.F_landline,family.mName AS mother,family.mOcc,Mcon.M_mobile,Mcon.M_mail,Mcon.M_landline,siblingDet.sibling_json AS siblings FROM `members` LEFT JOIN caste_religion ON caste_religion.caste_id = members.caste_rel_id LEFT JOIN contact_details on members.contact_id = contact_details.contact_id LEFT JOIN address ON members.a_id = address.a_id LEFT JOIN family ON members.family_id = family.pId LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS F_mobile,contact_details.mail_id AS F_mail,contact_details.landline AS F_landline FROM family LEFT JOIN contact_details ON family.fCId = contact_details.contact_id) Fcon ON Fcon.pId = members.family_id LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS M_mobile,contact_details.mail_id AS M_mail,contact_details.landline AS M_landline FROM family LEFT JOIN contact_details ON family.mCId = contact_details.contact_id) Mcon ON Mcon.pId = members.family_id LEFT JOIN (SELECT sibling.f_id,JSON_ARRAYAGG(JSON_OBJECT('age', age, 'gender', sex, 'marital_status', marital_status)) AS sibling_json from sibling where 1) siblingDet ON siblings.f_id = members.family_id

SELECT f_id,GROUP_CONCAT(JSON_OBJECT('age', age, 'gender', sex, 'marital_status', marital_status)) AS sibling_json from sibling GROUP BY f_id





SELECT members.id,members.join_date,members.name,members.dob,members.height,members.physique,members.gender,members.occupation,members.qualification,members.photo,members.complexion,members.star,members.horoscope,caste_religion.religion,caste_religion.caste,contact_details.mobile_no,contact_details.mail_id,contact_details.landline,address.address,address.city,address.district,address.pin,address.landmark,family.fName AS father,family.fOcc,Fcon.F_mobile,Fcon.F_mail,Fcon.F_landline,family.mName AS mother,family.mOcc,Mcon.M_mobile,Mcon.M_mail,Mcon.M_landline,sibling_det.sibling_json AS siblings FROM `members` LEFT JOIN caste_religion ON caste_religion.caste_id = members.caste_rel_id LEFT JOIN contact_details on members.contact_id = contact_details.contact_id LEFT JOIN address ON members.a_id = address.a_id LEFT JOIN family ON members.family_id = family.pId LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS F_mobile,contact_details.mail_id AS F_mail,contact_details.landline AS F_landline FROM family LEFT JOIN contact_details ON family.fCId = contact_details.contact_id) Fcon ON Fcon.pId = members.family_id LEFT JOIN 
(SELECT family.pId,contact_details.mobile_no AS M_mobile,contact_details.mail_id AS M_mail,contact_details.landline AS M_landline FROM family LEFT JOIN contact_details ON family.mCId = contact_details.contact_id) Mcon ON Mcon.pId = members.family_id LEFT JOIN 
(SELECT f_id,GROUP_CONCAT(JSON_OBJECT('age', age, 'gender', sex, 'marital_status', marital_status)) AS sibling_json from sibling GROUP BY f_id) sibling_det ON sibling_det.f_id = members.family_id