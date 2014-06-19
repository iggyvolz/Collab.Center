<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script src="docs/tools/Cookies.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="dialog.js"></script>
	<link rel="icon" href="./docs/faviconold.ico" type="image/x-icon">
	<link rel="shortcut icon" href="./docs/faviconold.ico" type="image/x-icon">
	<link rel="stylesheet" href="docs/tools/style.css">
	<title>Collab.Center - Online, Collaborative Coding in Real-Time!</title>
	<style>
		div:not(#dialogs) {
			width: 600px;
			margin: 5em auto;
			padding: 50px;
			border-radius: 1em;
			background-color: white;
			box-shadow: 1em;
			text-align: center;
		}

		span {
			color: red;
			font-weight: bold;
			display: inline;
		}

		sup {
			color: red;
			text-transform: uppercase;
			font-weight: normal;
			font-size: small;
		}

		footer {
			color: darkgray;
			position: relative;
			bottom: 0;
		}

		footer a {
			color: black;
		}

		p {
			text-align: center;
		}
	</style>
</head>
<body style="background-color: lightgray; font-family: Helvetica, Arial, sans-serif;">
	<div id="google_ads_frame1" style="position: absolute; left: -999999999999999999999999999999999em;">holmes is a very cool browser cuz its fast free and powerful</div>

	<!--Dialogs-->
	<div id="dialogs" style="position: absolute; right: 10px; top: 10px;">
		<div id="w3cD" style="display: none;"><a href="http://validator.w3.org/check?uri=http%3A%2F%2Fcollabcenter.net84.net%2F" style="color: #666;">HTML 5.0 Validated!</a></div>
		<div id="adblockD" style="display: none;"><br>Our website can only be hosted and running because of our ads. Please consider disabling your AdBlocker</div>
		<div id="welcomeD" style="display: none;"></div>
	</div>

	<a href="https://github.com/Mulletfingers999/Collab.Center" style="display: none;"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>	<div>
	<h1>Welcome to Collab.Center!<sup>Beta</sup></h1>
	<h2 id="collabcode"></h2>
	<p>Collab.center is an easy way to share collaborative coding docs or even plain text online! Just select a language and your ready to go!</p>
	<form method="post" id="create">
		<label for="language">Language:&nbsp;</label><select name="language" id="language">
		<option selected>Plain Text</option><option>apl</option><option>asterisk</option><option>c</option><option>c++</option><option>c#</option><option>clojure</option><option>cobol</option><option>coffeescript</option><option>commonlisp</option><option>css</option><option>d</option><option>diff</option><option>dtd</option><option>ecl</option><option>eiffel</option><option>erlang</option><option>f#</option><option>fortran</option><option>gas</option><option>gfm</option><option>gherkin</option><option>go</option><option>groovy</option><option>haml</option><option>haskell</option><option>haxe</option><option>htmlembedded</option><option>htmlmixed</option><option>http</option><option>jade</option><option>java</option><option>javascript</option><option>jinja2</option><option>julia</option><option>livescript</option><option>lua</option><option>markdown</option><option>mirc</option><option>nginx</option><option>ntriples</option><option>ocaml</option><option>octave</option><option>pascal</option><option>pegjs</option><option>perl</option><option>php</option><option>pig</option><option>properties</option><option>puppet</option><option>python</option><option>q</option><option>r</option><option>rpm</option><option>rst</option><option>ruby</option><option>rust</option><option>sass</option><option>scheme</option><option>shell</option><option>sieve</option><option>smalltalk</option><option>smarty</option><option>smartymixed</option><option>solr</option><option>sparql</option><option>sql</option><option>stex</option><option>tcl</option><option>tiddlywiki</option><option>tikiwiki</option><option>toml</option><option>turtle</option><option>vb</option><option>vbscript</option><option>velocity</option><option>verilog</option><option>xml</option><option>xquery</option><option>yaml</option><option>z80</option></select><span class="select-arrow"></span>
		<?php
		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}

		if (isset($_POST['Submit'])) {
			$lang = $_POST['language'];

			if (isset($lang)) {
				$my_dir = "";
				$my_file = "";
				$randString = generateRandomString();

				if (isset($_COOKIE["email"])) {
					//Check if the user's email dir exists, if not create one
					if (!file_exists("docs/".$_COOKIE["email"])) {
						mkdir("docs/".$_COOKIE["email"]);
					}

					$my_dir = "docs/".$_COOKIE["email"]."/".$randString;
					$my_file = $my_dir."/index.php";

				} else {
					//User is not signed in, create a new directory
					$my_dir = "docs/dev/".$randString;
					$my_file = $my_dir."/index.php";
				}

				//Create the file + directory if it doesn't exist
				if (!file_exists($my_file)) {
					mkdir($my_dir);
					$handle = fopen($my_file, 'w');
				}

				//Write to the index (.php)
				$data = file_get_contents('./docs/tools/index.html', true);
				fwrite($handle, $data);

				//Create the id.js file
				$user_id_file = $my_dir."/id.js";
				$handle_user_id = fopen($user_id_file, 'w');
				fwrite($handle_user_id, "var padId = '".$randString."';");

				//redirect to the new document
				echo '<script>window.location.href="'.$my_dir.'?lang='.urlencode($lang).'";</script>';

			} else {
				echo "<br><span>Please select a language, that's why its there.</span>";
			}
		}
		?>
		<br><br>
		<input type="submit" value="Create Doc!" style="font-size: 1.5em;" name="Submit">
	</form>
</div>
<footer><p>Copyright (c) 2014, Liam O'Flynn. All rights reserved. <a href="./terms#terms">Privacy Policy & Terms of Use</a>, Updated 6/8/2014</p></footer>
<script>
	dialog("w3cD", 'w3cvalidhtml.gif', 'Thu, 18 Dec 2013 12:00:00 GMT');

	if($("#google_ads_frame1").css('display')=="none")
	{
        dialog('adblockD', 'noadblock.png', 'Thu, 18 Dec 19 12:00:00 GMT');//.html("We noticed you have an active Ad Blocker. Example.com is ad funded, we promise our ads are of high quality and are unobtrusive. The best help you could provide to keep us running, is to whitelist us in your ad blocker. Thanks!");
    }
    else
    {
    	$("#adblockD").hide();
    }

    if (Cookies.get('name') != undefined) {
    	$("#welcomeD").html("Welcome Back, " + Cookies.get('name'));
    	dialog('welcomeD', 'none', 'foo')
    }
</script>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
	var sc_project=9847367; 
	var sc_invisible=1; 
	var sc_security="8d165f65"; 
	var scJsHost = (("https:" == document.location.protocol) ?
		"https://secure." : "http://www.");
	document.write("<sc"+"ript type='text/javascript' src='" +
		scJsHost+
		"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="free hit
	counters" href="http://statcounter.com/"
	target="_blank"><img class="statcounter"
	src="http://c.statcounter.com/9847367/0/8d165f65/1/"
	alt="free hit counters"></a></div></noscript>
	<!-- End of StatCounter Code for Default Guide -->
</body>
</html>