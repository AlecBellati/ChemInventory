		</div>
		<div id="footer">
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			&copy 2015, School of Chemical Engineering, The University of Adelaide
			<br />
			<?php
				if (loggedIn()){
					echo '<a href="'.ROOT_PATH.'administration/signout/">Sign out</a><br />';
				}
				else{
					echo '<a href="'.ROOT_PATH.'administration/login/">Log in</a><br />';
				}
			?>
		</div>
	</body>
</html>