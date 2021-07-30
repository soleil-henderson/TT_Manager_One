<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if($_SERVER["REQUEST_METHOD"] == 'GET'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Users.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $users = new Users($db);
    
    $stmt = $users->getAllUsers();

    if($stmt->rowCount() > 0)
    {
        $users_array = [];
        $users_array["users"] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $data = [
                "id" => $id,
                "name" => $name,
                "email" => $email
            ];

            $users_array["users"][] = $data;
        }

        http_response_code(200);
        print_r(json_encode($users_array));
    }
}
else 
{
    http_response_code(405);
    echo "Method Not Allowed";
    die();
}


?>