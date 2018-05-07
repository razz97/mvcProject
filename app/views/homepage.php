<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="style/home.css" rel="stylesheet" type="text/css"/>
        <style>
            .info{
                border: 1px solid red;
                background-color: rgb(255, 200,200);
                color:red;
                border-radius: 5px;
                box-shadow: 1px 1px 4px gray;
                padding: 10px;
                margin: 1em auto;
                width: 400px;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Welcome to my slim app!</h1>
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
		<?php echo $flash->getMessage('info')[0] ?> 
    </body>
</html>