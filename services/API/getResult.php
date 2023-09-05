

<?php 

include("./Connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['function_name']) || !isset($_POST['qury'])) {
        $response = array(
            'success' => false,
            'status' => 400,
            'message' => 'Bad Request'
        );
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $pdo->prepare($_POST['qury']);
        $stmt->execute();
        
    } catch (PDOException $e) {
        //throw $th;
    }




}







?>

