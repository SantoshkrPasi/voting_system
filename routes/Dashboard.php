<?php
    session_start();
    if(!isset($_SESSION['userdata']))
    {
        header("location: ../Login.html");
    }
    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status'] == 0)
    {
        $status = '<b style = "color : red" >Not Voted</b>';
    }
    else
    {
        $status = '<b style = "color : green" >Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
body
{
    overflow-x:hidden;
}
.section
{
    width : 100%;
    height : 100%;
    padding: 10px;
}
.header{
 height: 20%;
}
.main 
{
    border: 1px solid red;
    background-color: blue;
    display: flex;
    align-items : center;
    justify-content : space-between;
    padding: 20px;   
}

.profile
{
    border: 1px solid black;
    background-color: white;
    padding: 10px;
    margin : 10px;
}

.group
{
    border: 1px solid yellow;
    background-color: pink;
    padding: 30px;
    margin : 10px;
    width : 60%;
}
.content
{
    display: flex;
    flex-direction: row-reverse;
    align-items : center;
    justify-content : space-between;
    height : 80%;
    padding: 10px;
}
#votebtn
{
    padding : 5px;
    font-size : 15px;
    background-color : red;
    color : white;
    border-radius : 5px;
}
#voted
{
    padding: 5px;
    font-size :15px;
    background-color : green;
    color : white;
    border-radius : 5px;
}
.button
{
    display: flex;
    justify-content : space-between;
    align-items : center ;
}

.btn
{
    padding : 10px;
    margin : 10px;
    background-color : yellow;
}

</style>
<div class="section">
    <div class="head">
        <h1 style="text-align: center; margin: 20px;">Online Voting System</h1>
        <div class="button">
        <a href="../Login.html"><button type="button" class="btn">Back</button></a>
        <a href="logout.php"><button type="button" class="btn">Logout</button></a>
        </div>
        <hr style="width: 100%; height: 5px; border: 2px solid black; background-color:blueviolet;">
    </div>
    <div class = "main">
        <div class = "profile">
            <img src = "../upload/<?php echo $userdata['photo'] ?>" >
            <h1>Name : <?php echo $userdata['name'] ?></h1>
            <h1>Mobile : <?php echo $userdata['mobile'] ?></h1>
            <h1>Address : <?php echo $userdata['address'] ?></h1>
            <h1>Status : <?php echo $status ?></h1>
        </div>
        <div class = "group">
            <?php 
            if( $_SESSION['groupsdata'])
            {
                for($i = 0 ; $i < count($groupsdata) ; $i++)
                {
                    ?>
                <div class = "content">
                    <img src="../upload/<?php echo $groupsdata[$i]['photo']?>" height = "100" width = "100">
                    <h3>Group Name : <?php echo $groupsdata[$i]['name'] ?></h3>
                    <h3>Votes : <?php echo $groupsdata[$i]['votes'] ?></h3>
                    <form action = "../api/vote.php" method = "POST">
                        <input type="hidden" name = "gvotes" value = "<?php echo $groupsdata[$i]['votes']?>">
                        <input type="hidden" name = "gid" value = "<?php echo $groupsdata[$i]['id']?>">
                        <?php
                        if($_SESSION['userdata']['status'] == 0){
                            ?>
                          <input type="submit" name = "votebtn" value="vote" id="votebtn"> 
                          <?php 
                        }
                        else
                        {
                            ?>
                        <button disabled type="button" name = "votebtn" value="vote" id="voted"></button>  
                        <?php   
                        }
                        ?>
                    </form>
                </div>
                <?php
                }
            }
            else
            {
            }
            ?>

        </div>
    </div>
    </div>  
</body>
</html>