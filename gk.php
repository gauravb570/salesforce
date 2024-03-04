<?php
ini_set('display_errors', 0);
require_once ('soapclient/SforceEnterpriseClient.php'); // Include the Salesforce PHP Toolkit

$mySforceConnection = new SforceEnterpriseClient(); // Create a new Salesforce client object
$mySforceConnection->createConnection('enterprise.wsdl.xml'); // Specify the WSDL file path

$username = 'vershdropbox@devdrop.com'; // Your Salesforce username
$password = 'Welcome2024'; // Your Salesforce password
$security_token = '2dmVfrqpVPjSS1RvwJg63j0uZ'; // Your Salesforce security token

$mySforceConnection->login($username, $password . $security_token); // Login to Salesforce

$query = "SELECT Id, OwnerId, IsDeleted, Name, CreatedDate, CreatedById, LastModifiedDate, LastModifiedById, SystemModstamp, LastViewedDate, LastReferencedDate, URL__c, To_Be_Synced__c FROM Media_Links__c";
$response = $mySforceConnection->query($query); // Query for object metadata 
//foreach ($response->records as $record) {
    
//}

?>