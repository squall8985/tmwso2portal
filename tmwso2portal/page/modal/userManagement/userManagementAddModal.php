<div id="popupModalAddUser" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" style="height:50%; width:90%;">
		<div class="modal-content">
			<div class="panelHeader">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<h3>User Management - Add</h3>			
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<div class="wrap-input100 validate-input" data-validate="Name is required" style="width:400px;">
                            <input class="addModal input100" type="text" name="popupModalAddUserName" id="popupModalAddUserName" placeholder="Name">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                            	<i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Username (email) is required" style="width:400px;">
                            <input class="addModal input100" type="text" name="popupModalAddUserUsername" id="popupModalAddUserUsername" placeholder="Username (email)">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                            	<i class="fa fa-save" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required" style="width:400px;">
                            <input class="addModal input100" type="password" name="popupModalAddUserPassword" id="popupModalAddUserPassword" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                            	<i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required" style="width:400px;">
                            <font id="popupModalAddUserMessage" style="color: red;"></font>
                        </div>
					</div>
				</div>
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
        				<div class="panel panel-default">
                          <div class="panel-body">
                          	<div class="col-md-12" style= "margin-bottom: 10px;">
            					<div class="col-md-12">
            						<h3>Access Rights</h3>			
            					</div>
            				</div>
                             <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTablesModals">
                                   <thead>
                                      <tr>
                                      	 <th style="font-size:12px;vertical-align:middle;text-align:center;">DASHBOARD</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">BUSINESS EVENT</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">ONLINE</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">BATCH</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">SMS</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">QUERY</th>
                                         <th style="font-size:12px;vertical-align:middle;text-align:center;">USER MANAGEMENT</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                   	  <tr>
                                      	 <td style="font-size:12px; vertical-align:middle;text-align:center;">
                                      	 	<input type="checkbox" id="popupModalAddUserDashboard" name="popupModalAddUserDashboard" value="1" />
                                      	 </td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserBusinessEvent" name="popupModalAddUserBusinessEvent" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserOnline" name="popupModalAddUserOnline" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserBatch" name="popupModalAddUserBatch" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserSMS" name="popupModalAddUserSMS" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserQuery" name="popupModalAddUserQuery" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalAddUserUserManagement" name="popupModalAddUserUserManagement" value="1" /> </td>
                                      </tr>
                                </table>
                             </div>
                          </div>
                       </div>
                	</div>
				</div>
			</div>
			<div class="modal-footer" style="padding-top:10px;">
				<div class="row col-md-12" style="padding-top:10px;">
					<button type="button" class="btn btn-default" onClick="addUserSubmitAjax();">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>				
			</div>
		</div>
	</div>
</div>