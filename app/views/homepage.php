<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="style/home.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <h1>Welcome to my slim app!</h1>
		</header>
		
		<div id="forVerticalAlign"></div>
		<div id="loginDiv">
			<h3>Log in</h3>
			<form method="GET" action="/authentification">
				<table>
					<tr><td><label for="usr">Username: </label></td><td><input type="text" name="usr" id="usr" required /></td></tr>
                    <tr><td><label for="passwd">Password: </label></td><td><input type="password" name="passwd" id="passwd" required /></td></tr>
					<tr><td colspan="2" class="submit"><input type="submit" name="loginSubmit" id="loginSubmit" value="Log in" /></td></tr>						
				</table>
			</form>
		</div>
		<div id="signinDiv">
			<h3>Register</h3>
			<form method="POST" action="/register">
				<table>
					<tr><td><label for="usr">Username: </label></td><td><input type="text" name="usr" id="usr" required /></td></tr>
                    <tr><td><label for="passwd">Password: </label></td><td><input type="password" name="passwd" id="passwd" required /></td></tr>
                    <tr><td><label for="passwdRepeat">Repeat password: </label></td><td><input type="password" name="passwdRepeat" id="passwdRepeat" required /></td></tr>
					<tr><td colspan="2" class="submit"><input type="submit" name="loginSubmit" id="loginSubmit" value="Register" /></td></tr>
				</table>
			</form>
		</div>
		<p> <?php echo $this->flash->getMessage('info')[0] ?> </p>
    </body>
</html>