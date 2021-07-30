<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] == 'DELETE'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $task = new Tasks($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id))
    {
        $task->id = $data->id;

        if($task->deleteTask())
        {
            http_response_code(200);
            echo json_encode(["Task has been deleted from the database"]);
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
    echo "Method Not Allowed";
    die();
}