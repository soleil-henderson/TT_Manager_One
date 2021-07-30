const createUser = "http://localhost/TT_Manager_One/Backend/API/UserService/create.php";
const getUsersUrl = "http://localhost/TT_Manager_One/Backend/API/UserService/read.php";

// create user
$('#createUser').on("submit", function(e) {
    let data = {
    "name": $("#username").val(),
    "email": $("#email").val()
}
$.ajax({
    url: createUser,
    data : JSON.stringify(data),
    method: 'POST',
    processData: false,
    success: function(data) {
        console.log(data);
    },
    error: function(err) {
        console.log(err);
    }
});
});


// get users
$.ajax({
    url: getUsersUrl,        
    type: 'GET',
    success : function(data, status){
        console.log("DATA: " + data + "\nSTATUS: " + status);
            
        var responseData = data;
        var responseStatus = status;
    }
})

