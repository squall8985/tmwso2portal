<div id="popupModalChangePassword" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" style="height:50%; width:50%;">
		<div class="modal-content">
			<div class="panelHeader">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<h3>User Management - Admin Reset Password</h3>			
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<p><b>Name : </b><font id="popupModalChangePasswordName"></font></p>
						<p><b>Username : </b><font id="popupModalChangePasswordUsername"></font></p>
						<p><b>Status : </b><font id="popupModalChangePasswordStatus"></font></p>
						<p><b>Password : </b><input type="password" name="popupModalChangePasswordPassword" id="popupModalChangePasswordPassword" /></p>
						<p><font id="popupModalChangePasswordMessage"style="color: red;"></font></p>
						<input type="hidden" name="popupModalChangePasswordId" id="popupModalChangePasswordId" />
					</div>
				</div>
			</div>
			<div class="modal-footer" style="padding-top:10px;">
				<div class="row col-md-12" style="padding-top:10px;">
					<button type="button" class="btn btn-default" onClick="changePasswordAjax();">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>				
			</div>
		</div>
	</div>
</div>