<div id="content">
    <?php
        if (isset($_SESSION["xicon1"])) {
            echo "<div id='icon_1' class='icon' style='left:" . $_SESSION["xicon1"] . "; top:" . $_SESSION["yicon1"] . ";'></div>";
        } else {
            echo "<div id='icon_1' class='icon' style='left: 15px; top: 15px;'></div>";
        }
                    
        if (isset($_SESSION["xicon2"])) {
            echo "<div id='icon_2' class='icon' style='left:" . $_SESSION["xicon2"] . "; top:" . $_SESSION["yicon2"] . ";'></div>";
        } else {
            echo "<div id='icon_2' class='icon' style='left: 15px; top: 94px;'></div>";
        }
                    
        if (isset($_SESSION["xicon3"])) {
            echo "<div id='icon_3' class='icon' style='left:" . $_SESSION["xicon3"] . "; top:" . $_SESSION["yicon3"] . ";'></div>";
        } else {
            echo "<div id='icon_3' class='icon' style='left: 15px; top: 174px;'></div>";
        }
        
        if (isset($_SESSION["xicon4"])) {
            echo "<div id='icon_4' class='icon' style='left:" . $_SESSION["xicon4"] . "; top:" . $_SESSION["yicon4"] . ";'></div>";
        } else {
            echo "<div id='icon_4' class='icon' style='left: 109px; top: 15px;'></div>";
        }
        
        if (isset($_SESSION["xicon5"])) {
            echo "<div id='icon_5' class='icon' style='left:" . $_SESSION["xicon5"] . "; top:" . $_SESSION["yicon5"] . ";'></div>";
        } else {
            echo "<div id='icon_5' class='icon' style='left: 218px; top: 15px;'></div>";
        }
        
        if (isset($_SESSION["xicon6"])) {
            echo "<div id='icon_6' class='icon' style='left:" . $_SESSION["xicon6"] . "; top:" . $_SESSION["yicon6"] . ";'></div>";
        } else {
            echo "<div id='icon_6' class='icon' style='left: 109px; top: 94px;'></div>";
        }
        /*       
        if ($_SESSION["open"] == 1) {
            echo "<div id='window' style='visibility: visible; left:" . $_SESSION["xwindow"] . "; top:" . $_SESSION["ywindow"] . ";'>";
        } else if ($_SESSION["open"] == 0) {
            echo "<div id='window' style='visibility: hidden; left:" . $_SESSION["xwindow"] . "; top:" . $_SESSION["ywindow"] . ";'>";
        } 
        */
    ?>
	<?php
	if (isset($_SESSION["windowInfo"]) && $_SESSION["windowInfo"] == "open") {
		$display = "block";
		$index = 1;
	} else {
		$display = "none";
		$index = 0;
	}
	if (isset($_SESSION["x_windowInfo"])) {
		echo "<div id='windowInfo' style='display: ".$display."; left:".$_SESSION["x_windowInfo"]."; top: ".$_SESSION["y_windowInfo"]."; z-index:".$index."'>";
	} else {
		echo "<div id='windowInfo' style='display: ".$display."; left: 300px; top: 65px'>";
	}
	?>
		<div class="windowBar">
			<div id="closeInfo" class="close">
			Close
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="windowContent">
			<div id="infoContent" class="content"></div>
		</div>
	</div>
	<?php
	if (isset($_SESSION["windowAccount"]) && $_SESSION["windowAccount"] == "open") {
		$display = "block";
		$index = 1;
	} else {
		$display = "none";
		$index = 0;
	}
	if (isset($_SESSION["x_windowAccount"])) {
		echo "<div id='windowAccount' style='display: ".$display."; left: ".$_SESSION["x_windowAccount"]."; top: ".$_SESSION["y_windowAccount"]."; z-index:".$index."'>";
	} else {
		echo "<div id='windowAccount' style='display: ".$display."; left: 300px; top: 65px'>";
	}
	?>
		<div class="windowBar">
			<div id="closeAccount" class="close">
			Close
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="windowContent">
			<div id="accountContent" class="content"></div>
		</div>
	</div>
	<?php
	if (isset($_SESSION["windowPhoto"]) && $_SESSION["windowPhoto"] == "open") {
		$display = "block";
		$index = 1;
	} else {
		$display = "none";
		$index = 0;
	}
	if (isset($_SESSION["x_windowPhoto"])) {
		echo "<div id='windowPhoto' style='display: ".$display."; left: ".$_SESSION["x_windowPhoto"]."; top: ".$_SESSION["y_windowPhoto"]."; z-index:".$index."'>";
	} else {
		echo "<div id='windowPhoto' style='display: ".$display."; left: 300px; top: 65px'>";
	}
	?>
		<div class="windowBar">
			<div id="closePhoto" class="close">
			Close
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="windowContent">
			<div id="photoContent" class="content"></div>
		</div>
	</div>
	<?php
	if (isset($_SESSION["windowRss"]) && $_SESSION["windowRss"] == "open") {
		$display = "block";
		$index = 1;
	} else {
		$display = "none";
		$index = 0;
	}
	if (isset($_SESSION["x_windowRss"])) {
		echo "<div id='windowRss' style='display: ".$display."; left: ".$_SESSION["x_windowRss"]."; top: ".$_SESSION["y_windowRss"]."; z-index:".$index."'>";
	} else {
		echo "<div id='windowRss' style='display: ".$display."; left: 300px; top: 65px'>";
	}
	?>
		<div class="windowBar">
			<div id="closeRss" class="close">
			Close
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="windowContent">
			<div id="rssContent" class="content"></div>
		</div>
	</div>

	<div id="bar">
	<div id="start"></div>
	<div id="time">
	<?php
	
		$array = localtime(time(), 1);
		$hour = $array["tm_hour"];
		$min = $array["tm_min"];
	
		echo sprintf("%02d:%02d", $hour, $min) ;
	
	?>
	</div>
	<div style="clear: both"></div>
	</div>
	<div id="programs"></div>
<?php
	if (isset($_COOKIE['play']) && $_COOKIE['play'] == "true") {
		setcookie("play", "false", time() + 60*60*24*365);
		echo '<audio src="./snd/login.ogg" autoplay></audio>';
	}
    
?>
	<div id="menu" onclick="noopHandler(event)" oncontextmenu="return false;">
		<div class="menuElement">
			<a href="#" onclick="onClickDelete(event)">
				<img src="img/delete_icon.gif" alt="delete_icon.gif" class="menuPicture"></img>
				<div class="menuText">Delete</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 0)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Grayscale</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 1)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Negate</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 2)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Remove Mean</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 3)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Turn CW</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 4)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Turn CCW</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 5)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Mirror</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickPicture(event, 6)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Cut</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickRename(event)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Rename</div>
			</a>
		</div>
		<div class="menuElement">
			<a href="#" onclick="onClickDownload(event)">
				<img src="#" alt="" class="menuPicture"></img>
				<div class="menuText">Download</div>
			</a>
		</div>
	</div>
	<iframe id="downloadFrame" src="" style="visibility:hidden"></iframe>
</div>