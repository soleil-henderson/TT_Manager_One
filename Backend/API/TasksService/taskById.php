<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if($_SERVER["REQUEST_METHOD"] == 'GET'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';
    
    $database = new Db_connect();
    $db = $database->setConnection();

    $task = new Tasks($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($task->id ))
    {
        $task->id = $data->id;

        $task->getTaskById($data->id);

        if($task->id != null){

            $user_array = [
                "id" => $task->id,
                "title" => $task->title,
                "description" => $produit->description,
                "status" => $produit->status
            ];

            http_response_code(200);
            echo json_encode($user_array);
    }
    else
    {
        http_response_code(404);     
        echo json_encode(["User id do not exists"]);
    }
    }
}
else
{
    http_response_code(405);
    echo json_encode(["Method Not Allowed"]);
}