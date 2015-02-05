<?php
//Code for Header and Search Bar
function headerAndSearchCode(){
	@$defaultText = htmlentities($_GET['keywords']);

	echo '
		<header id="main_header">
			<div id="rightAlign">
	';
	//links will be here
	topRightLinks();
	echo "
			</div>
			<a href=\"index.php\"><img src=\"images/mainLogo.png\"></a>
		</header>

		<div id=\"top_search\">
			<form name=\"input\" action=\"search.php\" method=\"get\">
				<input type=\"text\" id=\"keywords\" name=\"keywords\" size=\"100\" class=\"searchBox\" value=\"$defaultText\"> &nbsp;
				<select id=\"category\" name=\"category\" class=\"searchBox\">
	";
	//include categories here
	createCategoryList();
	echo '
				</select>
				<input type="submit" value="Search" class="button" />
			</form>
		</div>
	';
}

//Top Right Links
function topRightLinks(){
	if( !isset($_SESSION['user_id']) || empty($_SESSION['user_id']) ){
		echo '<a href="register.php">Register</a> | <a href="login.php">Log In</a>';
	}
	else{
		$x = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM messages WHERE receiver=$x AND status='unread' ") or die(mysql_error());
		$num = mysql_num_rows($result);
		if($num==0){
			echo '<a href="messages_inbox.php">Messages</a> |';
		}
		else{
			echo "<span class=\"usernames\"><a href=\"messages_inbox.php\">Messages($num)</a></span> |";
		}
		echo '<a href="additem.php">Add Item</a> | <a href="account.php">My Account</a> | <a href="logout.php">Log Out</a>';
	}
}

//Creates Category <option>'s for search bar
function createCategoryList(){
	if( ctype_digit($_GET['category']) ){
		$x = $_GET['category'];
	}else{
		$x = 999;
	}
	echo "<option>All Categories</option>";
	$i = 0;
	while(1){
		if(numberToCategory($i)=="Category Does Not Exist"){
			break;
		}else{
			echo " <option value=\"$i\" ";
			if($i==$x){
				echo ' SELECTED ';
			}
			echo " >";
			echo numberToCategory($i);
			echo "</option>";
		}
		$i++;
	}
}

//Category Number to String
function numberToCategory($n){
	switch ($n) {
		case 0:
			$cat = "Antiques";
			break;
		case 1:
			$cat = "Art";
			break;
		case 2:
			$cat = "Automotives";
			break;
		case 3:
			$cat = "Baby";
			break;
		case 4:
			$cat = "Books";
			break;
		case 5:
			$cat = "Business & Industrial";
			break;
		case 6:
			$cat = "Cameras & Photo";
			break;
		case 7:
			$cat = "Clothing & Accessories";
			break;
		case 8:
			$cat = "Collectibles";
			break;
		case 9:
			$cat = "Computers";
			break;
		case 10:
			$cat = "Crafts";
			break;
		case 11:
			$cat = "DVD's & Movies";
			break;
		case 12:
			$cat = "Electronics";
			break;
		case 13:
			$cat = "Health & Beauty";
			break;
		case 14:
			$cat = "Home & Garden";
			break;
		case 15:
			$cat = "Jewelry & Watches";
			break;
		case 16:
			$cat = "Music";
			break;
		case 17:
			$cat = "Pet Supplies";
			break;
		case 18:
			$cat = "Services";
			break;
		case 19:
			$cat = "Sports & Outdoors";
			break;
		case 20:
			$cat = "Sports Memorabilia & Cards";
			break;
		case 21:
			$cat = "Tools & Home Improvement";
			break;
		case 22:
			$cat = "Toys & Hobbies";
			break;
		case 23:
			$cat = "Video Games";
			break;
		case 24:
			$cat = "Other";
			break;
		default:
			$cat = "Category Does Not Exist";
	}

	return $cat;
}

//Code for footer
function footerCode(){
	echo '
		<footer id="main_footer">
			<table>
				<tr>
					<td><a href="https://www.youtube.com/ifahification">Ifah YouTube</a></td>
					<td><a href="https://www.youtube.com/ifahification">Ifah Facebook</a></td>
					<td><a href="https://www.youtube.com/ifahification">Ifah Google+</a></td>
				</tr>
			</table>
		</footer>
	';
}

//Code for accont page links
include("functions/fun_userstats.php");
function accountLinks($x){
	$my_id = $_SESSION['user_id'];
	$allPending = calculateAllPendingItems();
	$allReported = calculateAllReportedItems();
	$usersActive = calculateUsersActiveItems($my_id);
	$usersPending = calculateUsersPendingItems($my_id);
	$usersOffersReceived = calculateUsersOffersReceived($my_id);
	$usersOffersMade = calculateUsersOffersMade($my_id);
	$usersCompletedTrades = calculateUsersCompletedTrades($my_id);
	$usersUnreadMessages = calculateUsersUnreadMessages($my_id);

	switch ($x){
			case 0: $additems = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 1: $myitems = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 2: $myprofile = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 3: $shippinginfo = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 4: $offersreceived = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 5: $offersmade = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 6: $offersdeclined = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 7: $completedtrades = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 8: $inbox = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 9: $sent = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 10: $trash = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 11: $compose = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 12: $pending = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 13: $reported = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 14: $myactive = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 15: $mypending = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 99: break;
		}	
}
?>