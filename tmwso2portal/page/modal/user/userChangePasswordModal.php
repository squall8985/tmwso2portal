<div id="popupModalPersonalChangePassword" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" style="height:50%; width:30%;">
		<div class="modal-content">
			<div class="panelHeader">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<h3>Self Update Password</h3>			
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="col-md-12" style= "margin-bottom: 10px;">
					<div class="col-md-12">
						<p>
							<b>Name : </b>
							<font id="popupModalPersonalChangePasswordName"></font>
						</p>
						<p>
							<b>Username : </b>
							<font id="popupModalPersonalChangePasswordUsername"></font>
						</p>
						<p>
							<div class="wrap-input100 validate-input" data-validate="Password is required">
                                <input class="input100" type="password" name="popupModalPersonalChangePasswordPassword" id="popupModalPersonalChangePasswordPassword" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                	<i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
						</p>
						<p>
							<div class="wrap-input100 validate-input" data-validate="Confirm password is required">
                                <input class="input100" type="password" name="popupModalPersonalChangePasswordPasswordConfirm" id="popupModalPersonalChangePasswordPasswordConfirm" placeholder="Confirm Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                	<i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        </p>
						<input type="hidden" name="popupModalPersonalChangePasswordId" id="popupModalPersonalChangePasswordId" />
					</div>
					<div class="col-md-12">
						<p>
							<font id="popupModalPersonalChangePasswordMessage"style="color: red;"></font>
						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="padding-top:10px;">
				<div class="row col-md-12" style="padding-top:10px;">
					<button type="button" class="btn btn-default" onClick="validateFormSubmit('<?php echo $_SESSION["SESS_MEMBER_ID"];?>');">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>				
			</div>
		</div>
	</div>
</div>