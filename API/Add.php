<?php
	$inData = getRequestInfo();
	
    $userID = $inData["userID"];
    $firstName = $inData["firstName"];
    $lastName = $inData["lastName"];
    $email = $inData["email"];
    $phone = $inData["phone"];


	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		
		$stmt = $conn->prepare("INSERT into contacts (firstName,lastName,email,phone,userID) VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssss",$firstName,$lastName,$email,$phone,$userID);
		$stmt->execute();
        $stmt->close();
		$conn->close();
        returnWithError("");
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
