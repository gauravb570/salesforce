<?php




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ('soapclient/SforceEnterpriseClient.php'); // Include the Salesforce PHP Toolkit



$mySforceConnection = new SforceEnterpriseClient(); // Create a new Salesforce client object

$mySforceConnection->createConnection('enterprise.wsdl.xml'); // Specify the WSDL file path



$username = 'vershdropbox@devdrop.com'; // Your Salesforce username

$password = 'Welcome2024'; // Your Salesforce password

$security_token = '2dmVfrqpVPjSS1RvwJg63j0uZ'; // Your Salesforce security token



$mySforceConnection->login($username, $password . $security_token); // Login to Salesforce



$query = "SELECT Id, OwnerId, IsDeleted, Name, CreatedDate, CreatedById, LastModifiedDate, LastModifiedById, SystemModstamp, LastViewedDate, LastReferencedDate, URL__c, To_Be_Synced__c FROM Media_Links__c";

$response = $mySforceConnection->query($query); // Query for object metadata 
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


foreach ($response->records as $record) {
	
    $url =  $record->URL__c;
    $file_name = generateRandomString(); 
    $upload_dir = 'files/';

// Check if the directory exists, if not, create it
if (!file_exists($upload_dir)) {
mkdir($upload_dir, 0777, true);
}

// Destination path where the file will be saved
$destination_path = $upload_dir . $file_name.'.mp4';

copy($url, $destination_path);

// Check if the file was downloaded and saved successfully
if (file_exists($destination_path)) {
echo "File downloaded and saved successfully.";

} else {
echo "Failed to download or save the file.";
}



}



?>

