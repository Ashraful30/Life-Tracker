
<?php 


	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:index.php");
	}

?>


<nav class="navbar navbar-dark navbar-expand-sm fixed-top">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand " href="home.php"><img src="img/symbol.png" height="32" width="32" alt="Logo" style="margin-right: -10px;"></a>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a id="hactive" class="nav-link" href="home.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="nav-item" ><a class="nav-link" id="mactive" href="admin/admin.php"><i class="fas fa-user"></i> Admin</a></li>
				<li class="nav-item"><a id="iactive" class="nav-link" href="income.php"><i class="fas fa-hand-holding-usd"></i> Income</a></li>
				<li class="nav-item" id="eactive"><a class="nav-link" href="expense.php"><i class="fas fa-donate"></i> Expense</a></li>
				<li class="nav-item" id="lactive"><a class="nav-link" href="life_event.php"><i class="fas fa-calendar-check"></i> Life Event</a></li>
			</ul>
			<ul class="navbar-nav demo">
				<li class="nav-item demo">
					<a href="" class="btn login" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-out-alt"></i> Logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">

    <div class="row">
		<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" >
					<div class="modal-header" style="border: none;">
						<div class="container">
							<div class="row">
								<h5 class="modal-title">Log out <i class="fas fa-lg fa-sign-out-alt"></i></h5>
								<button type="button" class="close pb-4" data-dismiss="modal" >
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
					<div class="modal-body mx-3">
						<p><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</p>

						<div class="modal-footer pt-4" style="border-top: none">
					        <form action="" method="post">
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        	<button type="submit" name="logout" class="btn btn-danger">Logout</button>
					        </form>
				      </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

</div>