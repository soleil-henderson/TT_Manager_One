<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if($_SERVER["REQUEST_METHOD"] == 'GET'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $tasks = new Tasks($db);
    
    $stmt = $tasks->getAllTasks();

    if($stmt->rowCount() > 0)
    {
        $tasks_array = [];
        $tasks_array["tasks"] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $data = [
                "id" => $id,
                "user_id" => $user_id,
                "title" => $title,
                "status" => $status,
                "description" => $description
            ];

            $tasks_array["tasks"][] = $data;
        }

        http_response_code(200);
        print_r(json_encode($tasks_array));
    }
}
else 
{
    http_response_code(405);
    echo "Method Not Allowed";
    die();
}


?>