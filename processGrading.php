<?php

    switch($_POST['action']) {
        case "getClasses":
            echo getClasses();
            break;
        case "getStudents":
            $_GET['classID'] = $_POST['classID'];
            echo getStudents($_POST['classID']);
            break;
        case "getSections":
            echo getSections($_POST['studentID']);
            break;
        default:
            echo "Switch statement has defaulted";
            break;
    }

    function getClasses() {
        include("db.php"); // As $db

        // Class Types: service and sales
        $query = "SELECT * FROM Class";

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
                  FROM Student
                  WHERE `Class ID` = :id";

        $argArray = array(":id" => $id);

        $stmt = $db->prepare($query);

        if($stmt->execute($argArray)) {
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $returnArray['students'][] = array(
                    "contactNo" => $result['Contact No_'],
                    "companyNo" => $result['Company No_'],
                    "name" => $result["Name"],
                    "phone" => $result['Phone'],
                    "grade" => $result['Final Grade']
                );

                $returnArray['headers'] = array(
                    "Contact No_", "Company No_", "Name", "Phone", "Final Grade"
                );
            }
            return json_encode($returnArray);
        }
        else {
            return json_encode(array("err" => "Error connecting to database"));
        }
    }

    function getSections($id) {
        include("db.php");

        $query = "SELECT *
                  FROM `Class Section`
                  WHERE Class = :id";
        
        $argArray = array(":id" => $id);

        $stmt = $db->prepare($query);

        if($stmt->execute($argArray)) {
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $returnArray['section'][] = array(
                    "classType" => $result['Class Type'],
                    "sectionID" => $result['Section ID'],
                    "title" => $result['Title'],
                    "startTime" => $result['Start Time'],
                    "endTime" => $result['End Time']
                );
                $returnArray['headers'] = array_keys($result);
            }
            return json_encode($returnArray);
        }
        else {
            return json_encode(array("err" => "Error connecting to database"));
        }
    }
