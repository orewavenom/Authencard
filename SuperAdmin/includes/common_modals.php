
	
	
	<!--  Print User Modal  -->
  <div id="PrintBulk" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="font-size: 14px; color: black;">
                <div class="modal-header" style="background: #222d32;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-weight: bold; color: #f0f0f0;">
                        <center>
                            PRINT SrNo IN BULK
                        </center>
                    </h4>
                </div>

                <?php 

                  $ret    = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM new_users ORDER BY id ASC"));
                  $idsat  = mysqli_num_rows(mysqli_query($db, "SELECT * FROM new_users ORDER BY id ASC"));

                ?>

                <input type="hidden" id="getStudentsRows" value="<?php echo $idsat; ?>">

                <form action="printbulk.php" method="post" target="_blank">
                    <div class="modal-body">
                        <div class="from-group">
                            <span class="input-group-addon">SrNo From (<b>Minimum 1</b>)</span>
                            <input type="number" class="form-control" name="startpoint" id="startpoint" required />
                        </div>
                        <div class="from-group mt-2">
                            <span class="input-group-addon">SrNo To (<b>Maximum <?php echo $idsat; ?></b>)</span>
                            <input type="number" class="form-control" name="endpoint" id="endpoint" required />
                        </div>

                        <input type="hidden" name="getFrom" id="idGetFrom" value="">
                        <input type="hidden" name="getTo" id="idGetTo" value="">

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" id="btns1" name="printBulk">Submit</button>
                    </div>
                </form>
            </div>
        </div>
  </div>


  <!--  Update User Modal  -->
  <div id="UpdateUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="font-size: 14px; color: black;">
                <div class="modal-header" style="background: #222d32;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #f0f0f0;">
                        <center>Edit details of 
                          <span id="title_name" class="title_name"></span>
                        </center>
                    </h4>
                    <br>
                </div>
                <form method="post" id="updateUsersData" enctype="multipart/form-data">
                    <div class="modal-body">
                        <center>

                            <div class="form-group">
                              <div class="checkbox-radios">
                                  <div class="form-check form-check-inline">
                                  <p style="margin-bottom: 10px;">
                                    <input style="margin-left: 8px;" type="radio" name="type" value="" /> N/A
                                    <input style="margin-left: 8px;" type="radio" name="type" value="Pro" /> Pro
                                    <input style="margin-left: 8px;" type="radio" name="type" value="Dr" /> Dr
                                    <input style="margin-left: 8px;" type="radio" name="type" value="Mr" /> Mr
                                    <input style="margin-left: 8px;" type="radio" name="type" value="Mrs" /> Mrs
                                    <input style="margin-left: 8px;" type="radio" name="type" value="Miss" /> Miss
                                  </p>
                                </div>
                              </div>
                            </div>

                            <table width="100%">
                              <tr>
                                <td><label for="">Full Name*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Surname Firstname Middlename" type="text" id="name" name="name" required maxlength="100" />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Guardian*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Enter Guardian Name" type="text" id="guardian" name="guardian" maxlength="50" required />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Address*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Enter Present Address" type="text" id="address" name="address" required maxlength="300" />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Phone*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Enter Phone" type="number" id="phone" name="phone" required maxlength="13" />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Email*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Enter Email" type="email" id="email" name="email" required />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Designation*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Enter Designation" type="text" id="designation" name="designation" required />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">DOB*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="DOB" type="date" id="dob" name="dob" required />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Blood Group*:</label></td>
                                <td>
                                  <div class="form-group bmd-form-group">
                                    <input class="form-control" placeholder="Blood Group" type="text" id="blood_grp" name="blood_grp" required />
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td><label for="">Profile Picture*:</label></td>
                                <td>
                                    <input class="form-control" name="filed" type="file" />
                                </td>
                              </tr>

                            </table>

                            <!-- <input type="hidden" name="page" id="staffid" /> -->
                            <input type="hidden" name="id" id="userid" />

                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button> &nbsp;
                        <input type="submit" class="btn btn-success" id="updatebtn" value="Reset (Submit)" name="resetuserdata" />
                    </div>
                </form>
            </div>
        </div>
  </div>