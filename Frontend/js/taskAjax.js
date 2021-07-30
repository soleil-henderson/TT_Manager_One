const getTasksUrl = "http://localhost/TT_Manager_One/Backend/API/TasksService/read.php";

$.ajax({
    url: getTasksUrl,        
    type: 'GET',
    success : function(data, status){
        console.log("dataTask: " + data + "\nstatus: " + status);
    }
})
