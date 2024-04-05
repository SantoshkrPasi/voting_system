<?php

   include("connect.php");

   $name = $_POST['name'];
   $mobile = $_POST['mobile'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];
   $address = $_POST['address'];
   $image = $_FILES['photo']['name'];
   $tmp_name = $_FILES['photo']['tmp_name'];
   $role = $_POST['role'];

   if($password == $cpassword)
   {
    move_uploaded_file($tmp_name,"../upload/$image");
    $insert = mysqli_query($connect , "INSERT INTO user (name,mobile,address,password,photo,role,status,votes) VALUES ('$name','$mobile','$address','$password','$image','$role',0,0)");
    if($insert)
    {
         echo `
         alert("Registration Successful");
         window.location = "../";
         `;
    } 
    else
    {
        echo `
        <script>
          alert("some error occurred");
          window.location = "../routes/register.html";
        </script>
        `;
    }  
}
else
{
    echo `
    <script>
      alert("Password and Confirm Password does not match!!");
      window.location = "../routes/register.html";
    </script>
    `;
}  
?>