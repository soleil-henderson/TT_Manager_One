<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if($_SERVER["REQUEST_METHOD"] == 'PUT'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Users.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $users = new Users($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id) && !empty($data->name) && !empty($data->email))
    {
        $users->id = $data->id;
        $users->name = $data->name;
        $users->email = $data->email;

        if($users->updateUser())
        {
            http_response_code(200);
            echo json_encode(["User has been modified in the database"]);
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