<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse"
		data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
		<span class="icon-bar"></span> <span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="TMindex.php">Smart Biz API Support Portal</a>
</div>
<ul class="nav navbar-top-links navbar-right">
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-user fa-fw"></i> <?php echo $staff_name; ?> 
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
			<li>
				<a href="functions/logout.php">
					<i class="fas fa-sign-out-alt fa-fw"></i>&nbsp;Logout
				</a>
			</li>
			<li>
				<a onclick="changePasswordPersonal('<?php echo $_SESSION["SESS_MEMBER_ID"];?>', '<?php echo $_SESSION["SESS_MEMBER_NAME"]?>', '<?php echo $_SESSION["SESS_MEMBER_USER_NAME"]?>');">
					<i class="fas fa-sign-out-alt fa-key"></i>&nbsp;Change Password
				</a>
			</li>
		</ul>
	</li>
</ul>
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search" style="padding-left: 25%;">
				<div class="input-group custom-search-form">
					<img src="images/unifi-logo-telekom.png" width="75" height="75">
				</div>
			</li>
				<?php if ($_SESSION["ROLE_DASHBOARD"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "DASHBOARD") echo 'class="active" '?> href="TMindex.php">
					<i class="fas fa-clipboard-list fa-fw"></i>&nbsp;Dashboard
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_QUERY"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "ONLINEQUERY") echo 'class="active" '?> href="onlineQuery.php">
					<i class="fas fa-book fa-fw"></i>&nbsp;Query
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_BUSINESS_EVENT"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "BUSINESSEVENT") echo 'class="active" '?>  href="businessEvent.php">
					<i class="fas fa-business-time fa-fw"></i>&nbsp;Business Event
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_ONLINE"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "ONLINE") echo 'class="active" '?> href="online.php">
					<i class="far fa-window-maximize fa-fw"></i>&nbsp;Online
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_BATCH"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "BATCH") echo 'class="active" '?> href="batchInterface.php">
					<i class="fas fa-book fa-fw"></i>&nbsp;Batch
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_SMS"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "SMS") echo 'class="active" '?> href="sms.php">
					<i class="fas fa-book fa-fw"></i>&nbsp;SMS
				</a>
			</li>
				<?php }?>
				<?php if ($_SESSION["ROLE_USER_MANAGEMENT"] == 1) {?>
			<li>
				<a <?php if ($MODULE == "USERMANAGEMENT") echo 'class="active" '?> href="userManagement.php">
					<i class="fas fa-users fa-fw"></i>&nbsp;User Management
				</a>
			</li>
				<?php }?>
		</ul>
	</div>
</div>
</div>