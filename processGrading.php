<?php

    echo getClasses();

    // switch($_POST['action']) {
    //     case "getClasses":
    //         echo getClasses();
    //         break;
    //     case "getStudents":
    //         echo getStudents($_POST['id']);
    //         break;
    //     case "getAssignments":
    //         echo getAssignments($_POST['id']);
    //         break;
    //     default:
    //         echo "Switch statement has defaulted";
    //         break;
    // }

    function getClasses() {
        include("db.php"); // As $db

        $query = "SELECT * FROM Classes";

        $argArrary; // null for now

        $stmt = $db->prepare($query);

        if($stmt->execute()) {
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $returnArray['classes'][] = $result;
                $returnArray['headers'] = array_keys($result);
            }
            return json_encode($returnArray);
        }
        else {
            return json_encode(array("err" => "Error connecting to database"));
        }
    }

    function getStudents($id) {
        include("db.php");

        $query = "SELECT *
                  FROM Students
                  WHERE Class = :id";

        $argArray = array(":id" => $id);

        $stmt = $db->prepare($query);

        if($stmt->execute($argArray)) {
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // $returnArray['ID'] = $result['ID'];
                // $returnArray['Name'] = $result['Name'];
                $returnArray['students'][] = array(
                    "id" => $result['ID'],
                    "name" => $result["Name"],
                    "class" => $result["Class"],
                    "company" => $result["Company"]
                );
                $returnArray['headers'] = array_keys($result);
            }
            return json_encode($returnArray);
        }
        else {
            return json_encode(array("err" => "Error connecting to database"));
        }
    }
