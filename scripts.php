<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask($conn);
    if(isset($_POST['update']))      updateTask($conn);
    if(isset($_POST['delete']))      deleteTask($conn);
    
     
    

    function getTasks($location,$conn)
    {
        //CODE HERE
        //SQL SELECT

        $sql = "SELECT * FROM tasks"; 
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
        // output data of each row
        $To_Do_compteur=0;
        $In_Progress_compteur=0;
        $Done_compteur=0;
        while($row = $result->fetch_assoc()) { 
         $title=$row["title"];
         $date=$row["task_datetime"];
         $description=$row["description"];
            if( $row["type_id"]=="1"){
                $type='Feature';
            }else{
                $type='Bug';
            }

            if($row["priority_id"]==1){
                $priority='Low';
            }elseif ($row["priority_id"]==2) {
                $priority='Medium';
            }elseif ($row["priority_id"]==3) {
                $priority='High';
            }else{
                $priority='Critical';
            }


            if($row["status_id"]==1){
                $status="To Do";
            }elseif ($row["status_id"]==2) {
                $status='In Progress';
            }else{
                $status="Done";
            }
            
            if($status =='To Do' && $status == $location){
                $To_Do_compteur++;
               
                
                echo'<script>to_do_tasks_count.innerHTML='.$To_Do_compteur.' </script>';
                echo '<button class="w-100 bg-white border-0 border-bottom text-start p-10px d-flex"  onclick="showform('.$id.',`'.$title.'`,`'.$status.'`,`'.$date.'`,`'.$description.'`,`'.$priority.'`,`'$type'`)">
                <div class="  col-1 fs-3 text-success">
                    <i class="fa-regular fa-circle-question"></i> 
                </div>
                <div class="">
                    <div value="'.$title.'" id="'.$row['id']."ts".'" class="h5">'.$title.'</div>
                    <input type="hidden" id="'.$row['id']."s".'" data="'.$status.'">
                    <div class="">
                        <div class=" text-gray" data="'.$date.'" id="'.$row['id']."d".'">#1 created in '.$date.'</div>
                        <div class=" text-black" data="'.$description.'" id="'.$row['id']."di".'" title="">'.$description.'</div>
                    </div>
                    <div class="">
                        <span class=" btn btn-primary btn-sm p-0 px-2 h6" data="'.$priority.'" id="'.$row['id']."p".'">'.$priority.'</span>
                        <span class=" btn btn-light btn-sm p-0  text text-black px-2 h6" data="'.$type.'" id="'.$row['id']."ty".'">'.$type.'</span>
                    </div>
                </div>
            </button>';
            }else if ($status=='In Progress' && $status==$location){
                $In_Progress_compteur++;
                echo'<script>in_progress_tasks_count.innerHTML='.$In_Progress_compteur.' </script>';
             
                echo '<button class="w-100 bg-white border-0 border-bottom text-start p-10px d-flex"  onclick="showform('.$id.',`'.$title.'`,`'.$status.'`,`'.$date.'`,`'.$description.'`,`'.$priority.'`,`'$type'`)">>
                <div class="  col-1 fs-3 text-success">
                <i class="fa-solid fa-circle-notch"></i> 
                </div>
                <div class="">
                    <div value="'.$title.'" id="'.$row['id']."ts".'" class="h5">'.$title.'</div>
                    <input type="hidden" id="'.$row['id']."s".'" data="'.$status.'">
                    <div class="">
                        <div class=" text-gray" data="'.$date.'" id="'.$row['id']."d".'">#1 created in '.$date.'</div>
                        <div class=" text-black" data="'.$description.'" id="'.$row['id']."di".'" title="">'.$description.'</div>
                    </div>
                    <div class="">
                        <span class=" btn btn-primary btn-sm p-0 px-2 h6" data="'.$priority.'" id="'.$row['id']."p".'">'.$priority.'</span>
                        <span class=" btn btn-light btn-sm p-0  text text-black px-2 h6" data="'.$type.'" id="'.$row['id']."ty".'">'.$type.'</span>
                    </div>
                </div>
            </button>';
            }else if($status=='Done' && $status==$location){
                $Done_compteur++;
                echo'<script>done_tasks_count.innerHTML="'.$Done_compteur.'" </script>';
                
                echo '<button class="w-100 bg-white border-0 border-bottom text-start p-10px d-flex"  onclick="showform('.$id.',`'.$title.'`,`'.$status.'`,`'.$date.'`,`'.$description.'`,`'.$priority.'`,`'$type'`)">">
                <div class="  col-1 fs-3 text-success">
                <i class="fa-regular fa-circle-check"></i>  
                </div>
                <div class="">
                    <div value="'.$title.'" id="'.$row['id']."ts".'" class="h5">'.$title.'</div>
                    <input type="hidden" id="'.$row['id']."s".'" data="'.$status.'">
                    <div class="">
                        <div class=" text-gray" data="'.$date.'" id="'.$row['id']."d".'">#1 created in '.$date.'</div>
                        <div class=" text-black" data="'.$description.'" id="'.$row['id']."di".'" title="">'.$description.'</div>
                    </div>
                    <div class="">
                        <span class=" btn btn-primary btn-sm p-0 px-2 h6" data="'.$priority.'" id="'.$row['id']."p".'">'.$priority.'</span>
                        <span class=" btn btn-light btn-sm p-0  text text-black px-2 h6" data="'.$type.'" id="'.$row['id']."ty".'">'.$type.'</span>
                    </div>
                </div>
            </button>';
            }
        
        }
        
        
    }
}




    function saveTask($conn)
    {
        //CODE HERE
        //SQL INSERT
        $title=$_POST['title'];
        $task_type=$_POST['task_type'];
        $priority=$_POST['priority'];
        $status=$_POST['status'];
        $date_datetime=$_POST['date'];
        $description=$_POST['description'];
        echo ($title. $task_type. $priority.$status. $date_datetime. $description); // affichage
        if($task_type=="Feature"){
            $type_id=1;
        }else{
            $type_id=2;
        }
        if($priority=="Low"){
            $priority_id=1;
        }elseif ($priority=="Medium") {
            $priority_id=2;
        }elseif($priority=="High"){
            $priority_id=3;
        }else{
            $priority_id=4;
        }
        if($status=="To Do"){
            $status_id=1;
        }elseif ($status=="In Progress"){
            $status_id=2;
        }else{
            $status_id=3;
        }
        echo($type_id. $priority_id. $status_id);// affichage


        $sql = "INSERT INTO tasks (title, type_id, priority_id, status_id, task_datetime, description )
        VALUES ('$title', '$type_id', '$priority_id' ,'$status_id','$date_datetime','$description')";
        
        $query=mysqli_query($conn,$sql);
        if(isset($query)){
            $_SESSION['message'] = "Task has been saved successfully !";
            header('location: index.php');

        }else{
            echo "<h1> erreur d'insertion</h1>";
        }




       
    }

    function updateTask($conn)
    {
        //CODE HERE  =
        $id = $_POST['task_id'];
        $title=$_POST['title'];
        $task_type=$_POST['task_type'];
        $priority=$_POST['priority'];
        $status=$_POST['status'];
        $date_datetime=$_POST['date'];
        $description=$_POST['description'];
        echo ($id. $title. $task_type. $priority.$status. $date_datetime. $description); // affichage
        if($task_type=="Feature"){
            $type_id=1;
        }else{
            $type_id=2;
        }
        if($priority=="Low"){
            $priority_id=1;
        }elseif ($priority=="Medium") {
            $priority_id=2;
        }elseif($priority=="High"){
            $priority_id=3;
        }else{
            $priority_id=4;
        }
        if($status=="To Do"){
            $status_id=1;
        }elseif ($status=="In Progress"){
            $status_id=2;
        }else{
            $status_id=3;
        }
        


        $sql = "UPDATE `tasks` SET `title`='$title',`type_id`='$type_id',`priority_id`='$priority_id',`status_id`='$status_id',`task_datetime`='$date_datetime',`description`='$description' WHERE `id` = '$id'";
       
        if(mysqli_query($conn,$sql)){
            $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
        }else{
            echo $conn->error;
        }
        //SQL UPDATE
        
    }

    function deleteTask($conn)
    {
        //CODE HERE

        $id = $_POST['task_id'];
        $sql = "DELETE FROM tasks WHERE  id=$id";
        if(mysqli_query($conn,$sql)){
            $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
        }else{
            echo $conn->error;
        }
        //SQL DELETE
        
    }

?>