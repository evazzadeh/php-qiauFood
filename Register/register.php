<?php																									// Pass form Variables as method = POST
$time = explode(' ', microtime());
$start = $time[1] + $time[0];

define('AUTHOR','Javad Evazzadeh');
include( 'simple_html_dom.php' );
echo '<title>Qiau Food</title>';

$username= $_POST['username'];
$password= $_POST['password'];
$department= $_POST['department'];
$secondpassword= $_POST['secondpassword'];
$days= array("����","������","�� ����","�������");
$reffer = "http://cyber5.qiau.ac.ir/iau/";

$url = "http://cyber5.qiau.ac.ir/iau/login.do"; 														// URL to POST FORM. (Action of Form)
$post_fields = 'command=Login&dispatch=&userName='.$username.'&password='.$password.'&department='.$department; 			// form Fields.
$cookie_file_path = "cookie.txt";
$ch = curl_init();																						// Initialize a CURL session.
set_time_limit(0);
$che = curl_init($url);

ob_start();  
curl_exec($che);
ob_end_clean();

$info = curl_getinfo($che);
if(curl_errno($che))
 {
	echo '<h1 align=center style="color:red">'.curl_error($che).'</h1>';
 }
else
 { 
	echo '<h5 align=center>'."Step1: "
		.'Took '.$info['total_time'].' seconds to send a request to '.$info['url'].'</h5>';				//Show Current Step
	
	
	echo '<hr noshade size=2 width="30%"><h4 align=center style="color:purple">'."Step2".'</h4>';		//login To mainPage
		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_REFERER, $reffer);
		curl_setopt($ch, CURLOPT_POST, 1); 																// use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
	//	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
/*		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page contents.
	*/
	
	echo '<hr noshade size=3 width="40%"><h4 align=center style="color:purple">Step3</h4>';				//login To FoodLoginPage
		$url = "http://cyber5.qiau.ac.ir/iau/home.do"; 													// URL to POST FORM. (Action of Form)
		$post_fields = 'changeMenuHiddenName=educational%2Fregistration%2Fregistration'; 				// form Fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page contents.

	echo '<hr noshade size=4 width="50%"><h4 align=center style="color:purple">Step4</h4>';				//login To mainPage
	
	
	



		//logout
	$info = curl_getinfo($ch);
	echo '<title>Food:LogOut</title>';
	echo '<hr noshade size=7 width="75%"><h1 align=center style="color:olive">LogOut Successful </h1>';
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 													// TRUE to follow any "Location: " 
		$url = "http://cyber5.qiau.ac.ir/iau/logOut.do"; 												// URL to POST FORM. (Action of Form)
		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
 }
curl_close($ch);																						// close curl resource, and free up system resources.

$time = explode(' ', microtime());
$finish = $time[1] + $time[0];
echo '<h3 align=center style="color:olive">Page generated in '.round(($finish - $start), 4).' seconds</h3>';

?>