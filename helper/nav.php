	<nav class="navbar navbar-dark navbar-expand-sm fixed-top">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand " href="../home.php"><img src="../img/symbol.png" height="32" width="32" alt="Logo" style="margin-right: -10px;"></a>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a id="hactive" class="nav-link my-style" href="../home.php"><i class="fa fa-home"></i> Home</a></li>

					<li class="nav-item dropdown">
						<a id="cactive" class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> Category</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="add_category.php">Add Category</a>
	                        <a class="dropdown-item" href="manage_category.php">Manage Category</a>
                        </div>
					</li>

					<li class="nav-item dropdown">
						<a id="iactive" class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i> Income</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="add_income.php">Add Income</a>
	                        <a class="dropdown-item" href="manage_income.php">Manage Income</a>
	                        <a class="dropdown-item" href="#">View Income</a>
                        </div>
					</li>

					<li class="nav-item dropdown" id="eactive">
						<a id="eactive" class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-donate"></i> Expense</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="add_expense.php">Add Expense</a>
	                        <a class="dropdown-item" href="manage_expense.php">Manage Expense</a>
	                        <a class="dropdown-item" href="#">View Expense</a>
                        </div>
					</li>

					<li class="nav-item dropdown" id="lactive">
						<a id="lactive" class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calendar-check"></i> Life Event</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="add_life_event.php">Add Life Event</a>
	                        <a class="dropdown-item" href="manage_life_event.php">Manage Life Event</a>
	                        <a class="dropdown-item" href="#">View Life Event</a>
                        </div>
					</li>					
				
				</ul>
				<ul class="navbar-nav demo">
					<li class="nav-item demo">
						<a href="" class="btn login" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-out-alt"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>