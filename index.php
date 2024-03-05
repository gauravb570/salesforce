<?php
require_once "vendor/autoload.php";

use Kunnu\Dropbox\Dropbox;

use Kunnu\Dropbox\DropboxApp;

use Kunnu\Dropbox\DropboxFile;

// Dropbox App Configuration

$dropboxKey = 'iw2jfx88rfdzzd2';

$dropboxSecret = '9shhh6ng05evwhd';

$accessTokendrop = 'sl.Bw2ontSyqSca0fyAXJO5E2muhg4Tzl15DyCvj8M89vMuwO0u7lYU8r7GT-DyJrl3dac32WDAuGAWDFeYYXW2bEEoIiX4eMXEAGekDouMpgVOEG0KpLvfTRdGSpK_QC-bRmsXuNv32KX6Kw0ULfN-Cxw';


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
    


// Destination path where the file will be saved
$destination_path =  "/".$file_name.'.mp4';



// Create Dropbox App instance

$app = new DropboxApp($dropboxKey, $dropboxSecret, $accessTokendrop);



// Create Dropbox instance

$dropbox = new Dropbox($app);



// Local file path

$localFilePath = $url;



// Remote file path (where you want to store the file in Dropbox)

$remoteFilePath = $destination_path;



// Create DropboxFile instance

$dropboxFile = new DropboxFile($localFilePath);





// Upload the file

$fileMetadata = $dropbox->upload($dropboxFile, $remoteFilePath, ['autorename' => true]);



// Check if the upload was successful

if ($fileMetadata) {

    echo "File uploaded successfully!";

} else {

    echo "Error uploading file.";

}
/*
copy($url, $destination_path);

// Check if the file was downloaded and saved successfully
if (file_exists($destination_path)) {
echo "File downloaded and saved successfully.";

} else {
echo "Failed to download or save the file.";
}
*/


}



?>

