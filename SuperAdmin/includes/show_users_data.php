<?php  
 
 include 'session.php';
 include 'connect_database.php';

 $output = '';
 $sql = "SELECT * FROM visitors ORDER BY id ASC";  
 $result = mysqli_query($db, $sql);
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
          $namev        =$found['namev'];


          $t_result = mysqli_query($db, "SELECT * FROM teachers WHERE id = '$namev'");
          $row     = mysqli_fetch_array($t_result);
          $teacher = $row['name'];

          $phonev       =$found['phonev'];
          $emailv       =$found['emailv'];
          $expiry       =$found['expiry'];
          $created      =$found['created'];
          $count        =$count+1;
          $time         =time();

          $output .= '  
                                        <tr data-id="'.$id.'" id="'.$id.'" class="'.$count.'">
                                           <td>'.$count.'</td>                                      
                                           <td>'.$name.'</td>         
                                           <td>'.$email.'</td>
                                           <td>'.$phone.'</td>
                                           <td>'.$teacher.'</td>
                                           <td>'.$phonev.'</td>
                                           <td>'.$emailv.'</td>
                                           <td>'.$expiry.'</td>
                                           <td>'.$created.'</td>
                                           <td class="td-actions text-right">
                                                <a href="ecard/'.$id.'" target="_blank" type="button" rel="tooltip" class="btn btn-info">
                                                    <i class="material-icons">print</i>
                                                </a>
                                                <a data-id="'.$id.'" href="javascript:;" onclick="delete_student('.$id.')" class="btn btn-danger" title="delete user"> 
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