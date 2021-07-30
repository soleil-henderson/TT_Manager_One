<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER["REQUEST_METHOD"] == 'POST'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Users.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $users = new Users($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->name) && !empty($data->email))
    {
        $users->name = $data->name;
        $users->email = $data->email;

        if($users->AddUser())
        {
            http_response_code(201);
            echo json_encode(["User has been added to the database"]);
        }
        else
        {
            http_response_code(503);
            echo json_encode(["Error"]);
        }
    }
}
else 
{
    http_response_code(405);
    echo "Metohd Not Allowed";
    die();
}