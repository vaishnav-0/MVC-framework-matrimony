<?php
define("DB_CONF", array(
    'dbname' => 'matrimony',
    'user' => 'vaichu',
    'password' => 'mysmysmys',
    'host' => 'localhost',
    'driver' => 'mysqli'
));
define("DB_META",array(                            
    "address"=> [
        "a_id",
        "address",
        "locality",
        "city",
        "district",
        "pin",
        "landmark"
    ],
    "caste_religion"=> [
        "caste_id",
        "caste",
        "religion"
    ],
    "contact_details"=> [
        "contact_id",
        "mobile_no",
        "mail_id",
        "landline"
    ],
    "family"=> [
        "pId",
        "fName",
        "mName",
        "fCId",
        "mCId",
        "fOcc",
        "mOcc"
    ],
    "members"=> [
        "id",
        "join_date",
        "name",
        "dob",
        "caste_rel_id",
        "height",
        "physique",
        "gender",
        "family_id",
        "occupation",
        "qualification",
        "photo",
        "contact_id",
        "complexion"
    ],
    "sibling"=> [
        "s_id",
        "f_id",
        "name",
        "age",
        "sex",
        "marital_status"
    ]
));
?>