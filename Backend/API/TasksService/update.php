<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if($_SERVER["REQUEST_METHOD"] == 'PUT'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $task = new Tasks($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->title) && !empty($data->description))
    {
        $task->title = $data->title;
        $task->description = $data->description;

        if($task->updateTask())
        {
            http_response_code(200);
            echo json_encode(["Task has been modified in the database"]);
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