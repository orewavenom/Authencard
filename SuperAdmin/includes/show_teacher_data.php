<?php  
 
 include 'session.php';
 include 'connect_database.php';

 $output = '';
 $sql = "SELECT * FROM teachers ORDER BY id ASC";  
 $result = mysqli_query($connect, $sql);
 $i = 1;
 $count = 0;

 if(mysqli_num_rows($result) > 0)  
 {  
      while($found = mysqli_fetch_array($result))  
      {     

          $id           =$found['id'];
          $name         =$found['name'];
          $email        =$found['email'];
          $phone        =$found['phone'];
          $created      =$found['created'];
          $count        =$count+1;
          $time         =time();

          $output .= '  
                                        <tr data-id="'.$id.'" id="'.$id.'" class="'.$count.'">
                                           <td>'.$count.'</td>                                      
                                           <td>'.$name.'</td>
                                           <td>'.$phone.'</td>
                                           <td>'.$email.'</td>
                                           <td>'.$created.'</td>
                                           <td class="td-actions text-right">
                                                <a data-id="'.$id.'" href="javascript:;" onclick="delete_teacher('.$id.')" class="btn btn-danger" title="delete user"> 
                                                  <i class="material-icons">delete</i>
                                                </a>
                                            </td>      
                                        </tr>

          ';

          $i++;
      }  
 }  
 else  
 {  
      $output .= '<tr>  
                    <td>Data not found (Please add users)</td>  
                  </tr>';  
 }

 echo $output; 

?>