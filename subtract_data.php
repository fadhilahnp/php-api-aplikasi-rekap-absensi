<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$param = $data["param"];

if ($param == "") $param = "all";

if ($param == "teacher") {
    $response = Array();
    $pin = $data["pin"];

    try {
        $stmt = $conn->prepare("DELETE FROM employee WHERE pin=:pin");
        $stmt->bindParam(':pin', $pin, PDO::PARAM_INT);
        $stmt->execute();

        $response = [
            'status' => 'success',
            'data' => null,
            'message' => 'Delete employee data success'
        ];
        
        echo json_encode($response);
    }
    catch(PDOException $e) {
        $response = [
            'status' => 'Error',
            'data' => null,
            'message' => $e->getMessage()
        ];
        echo json_encode($response);
    }

    $conn = null;
}
?>