<div id="popupModalEditUser" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" style="height:50%; width:90%;">
		<div class="modal-content">
			<div class="panelHeader">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<h3>User Management - Update</h3>			
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<p><b>Name </b><input class="ui-widget ui-widget-content ui-corner-all" type="text" name="popupModalEditName" id="popupModalEditName" />&nbsp;<font id="popupModalEditUserNameMessage"style="color: red;"></font></p>
						<p><b>Username </b><font id="popupModalEditUserUsername"></font></p>
						<p><b>Status </b><font id="popupModalEditUserStatus"></font></p>
						<p><b>Last Login </b><font id="popupModalEditUserLastLogin"></font></p>
						<input type="hidden" name="popupModalEditUserId" id="popupModalEditUserId" />
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
                                      	 <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserDashboard" name="popupModalEditUserDashboard" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserBusinessEvent" name="popupModalEditUserBusinessEvent" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserOnline" name="popupModalEditUserOnline" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserBatch" name="popupModalEditUserBatch" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserSMS" name="popupModalEditUserSMS" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserQuery" name="popupModalEditUserQuery" value="1" /></td>
                                         <td style="font-size:12px; vertical-align:middle;text-align:center;"><input type="checkbox" id="popupModalEditUserUserManagement" name="popupModalEditUserUserManagement" value="1" /> </td>
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
					<button type="button" class="btn btn-default" onClick="editUserSubmitAjax();">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>				
			</div>
		</div>
	</div>
</div>