<?php
//calculate all items pending for moderator
function calculateAllPendingItems(){
			$result = mysqli_query($mysql_connect, "SELECT item_number FROM items_available WHERE status='pending' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate all reported for moderator
function calculateAllReportedItems(){
			$result = mysqli_query($mysql_connect, "SELECT item_number FROM items_available WHERE status='reported' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users active items
function calculateUsersActiveItems($user){
			$result = mysqli_query($mysql_connect, "SELECT item_number FROM items_available WHERE owner_id='$user' AND status='active' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users pending items
function calculateUsersPendingItems($user){
			$result = mysqli_query($mysql_connect, "SELECT item_number FROM items_available WHERE owner_id='$user' AND status='pending' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users offers received
function calculateUsersOffersReceived($user){
			$result = mysqli_query($mysql_connect, "SELECT trade_id FROM offers_open WHERE receivers_id='$user' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users offers received
function calculateUsersOffersMade($user){
			$result = mysqli_query($mysql_connect, "SELECT trade_id FROM offers_open WHERE offerers_id='$user' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users offers received
function calculateUsersCompletedTrades($user){
			$result = mysqli_query($mysql_connect, "SELECT item_number FROM items_traded WHERE owner_id='$user' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}

//calculate users offers received
function calculateUsersUnreadMessages($user){
			$result = mysqli_query($mysql_connect, "SELECT id FROM messages WHERE receiver='$user' AND status='unread' ") or die(mysql_error());
			if(mysqli_num_rows($result)==0){
				return '';
			}else{
				return "(".mysqli_num_rows($result).")";
			}
}
?>