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
    $name = $data["name"];

    try {
        $stmt = $conn->prepare("UPDATE employee SET name = :name WHERE pin = :pin");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('pin', $pin);
        $stmt->execute();

        $response = [
            'status' => 'success',
            'data' => null,
            'message' => 'Edit employee data success'
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