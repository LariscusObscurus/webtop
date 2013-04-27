<div id="content">
    <div id="login">
        <form action="" method="post">
            <input type="text" name="username" id="userSubmit"/>
            <input type="password" name="password" id="userPaswd" />
            <input type="submit" name="login" value="Benutzer anmelden" onclick="onClickSubmit(event)" />
            <input type="button" name="reg" value="Benutzer registrieren" onclick="onClickRegister(event)" />
            <input type="checkbox" name="stay" value="stay" id="checkCookie" /> Stay
        </form>
	<div id='windowRegister' style='display: none'>
		<div class="windowBar">
			<div id="closeRegister" class="close">
			Close
			</div>
			<div style="clear: both"></div>
		</div>
		<div id="registerContent"></div>
	</div>
        <div id="error"><?php echo $error; ?></div>
    </div>
</div>
