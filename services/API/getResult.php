

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

        $record = '';
        if ($_POST['function_name'] === "GetData") {
            $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
        }

        

        $response = array(
            'success' => true,
            'status' => 200,
            'data'=>$record
        );
        echo json_encode($response);
        exit;

        
    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'status' => 500,
            'error' => $e->getMessage(),
        );
        echo json_encode($response);
        exit;
    }




}







?>

