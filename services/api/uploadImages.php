<?php

include './Connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_POST['id']) || $_POST['id'] == '') {
            $response = [
                'success' => false,
                'status' => 400,
                'error' => 'Id is required',
            ];
        } else {
            $stmt = $pdo->prepare('SELECT * FROM patrolling_survey WHERE id = :id');
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($record) {
                $destination = '../../assets/SiteImages/';
                $web_des = '/assets/SiteImages/';

                if (isset($_FILES['image_1'])) {
                    $img1 = rand() . $_FILES['image_1']['name'];
                    $after1 = $_FILES['image_1']['tmp_name'];
                    $image_1 = $web_des . $img1;

                    if (move_uploaded_file($after1, $destination . $img1)) {
                    }
                } else {
                    $image_1 = $record['image_1'];
                }

                if (isset($_FILES['image_2'])) {
                    $img2 = rand() . $_FILES['image_2']['name'];
                    $after2 = $_FILES['image_2']['tmp_name'];
                    $image_2 = $web_des . $img2;

                    if (move_uploaded_file($after1, $destination . $img2)) {
                    }
                } else {
                    $image_2 = $record['image_2'];
                }

                if (isset($_FILES['image_3'])) {
                    $img3 = rand() . $_FILES['image_3']['name'];
                    $after3 = $_FILES['image_3']['tmp_name'];
                    $image_3 = $web_des . $img3;

                    if (move_uploaded_file($after3, $destination . $img3)) {
                    }
                } else {
                    $image_3 = $record['image_3'];
                }

                $stmt = $pdo->prepare('UPDATE patrolling_survey SET image_1 = :img1 , image_2 = :img2 , image_3 = :img3 WHERE id = :id');
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->bindParam(':img1', $image_1);
                $stmt->bindParam(':img2', $image_2);
                $stmt->bindParam(':img3', $image_3);
                $stmt->execute();
                // $record = $stmt->fetch(PDO::FETCH_ASSOC);
                // }
                $response = [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Image inserted successfully',
                ];
            } else {
                $response = [
                    'success' => false,
                    'status' => 404,
                    'message' => 'User not found',
                ];
            }
        }
        echo json_encode($response);
        exit();
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'status' => 500,
            'error' => $e->getMessage(),
        ];
        echo json_encode($response);
        exit();
    }
}

?>
