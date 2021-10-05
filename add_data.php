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
    $status = 1;

    try {
        $stmt = $conn->prepare("INSERT INTO employee (pin, name, status) VALUES (?, ?, ?)");
        $stmt->execute([$pin, $name, $status]);

        $response = [
            'status' => 'success',
            'data' => null,
            'message' => 'Add employee data success'
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