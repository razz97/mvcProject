<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="style/user.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <h1>Welcome <?php echo $_SESSION['usr']; ?></h1>
		</header>
		<div id="divReceived">
			<h3>Received messages</h3>
			<table class="show">
				<tr><th>Sender</th><th>Subject</th><th>Body</th></tr>
				<?php
				if (isset($data["received"])) {
					foreach ($data["received"] as $msg) {
						echo "<tr><td>" . $msg["sender"] . "</td><td>" . $msg["subject"] . "</td><td>" . $msg["body"] . "</td></tr>";
					}
					
				} else {
					echo "<tr><td style='border:0'>No messages received yet.</td></tr>";
				}
				?>
			</table>
		</div>
		<div id="divSent">
			<h3>Sent messages</h3>
			<table class="show">
				<tr><th>Receiver</th><th>Subject</th><th>Body</th></tr>
				<?php
				if (isset($data["sent"])) {
					foreach ($data["sent"] as $msg) {
						echo "<tr><td>" . $msg["receiver"] . "</td><td>" . $msg["subject"] . "</td><td>" . $msg["body"] . "</td></tr>";
					}
				} else {
					echo "<tr><td style='border:0'>No messages sent yet.</td></tr>";
				}
				?>
			</table>

		</div>
		<div id="divSend">
			<h3>Send a message</h3>
			<form method="POST" action="/user/newMsg">
				<table>
					<tr><td><label for="receiver">User: </label></td><td>
							<select name="receiver" id="receiver">
								<?php
								foreach ($data["users"] as $usr) {
									echo "<option>" . $usr[0] . "</option>";
								}
								?>
							</select></td></tr>
					<tr><td><label for="subject">Subject: </label></td><td><input type="text" name="subject" required></td></tr>
					<tr><td><label for="body">Body: </label></td><td><textarea name="body" required></textarea></td></tr>
					<tr><td><input type="hidden" name="sender" value="<?php echo $_SESSION["usr"] ?>"></td></tr>
					<tr><td colspan="2" id="submit"><input type="submit" name="submitMsg" value="Send"></td></tr>
				</table>

			</form>
		</div>
		<div id="divLogout_Info">
			<p><?php echo $this->flash->getMessage('info')[0]; ?></p>
			<form action="/user/logOut" method="get">
				<input type="submit" name="submitLogOut" value="Log Out">
			</form>
		</div>
    </body>
</html>
