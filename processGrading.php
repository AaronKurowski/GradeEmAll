<?php

    echo getClasses();

    function getClasses() {
        include("db.php"); // As $db

        $query = "SELECT * FROM Classes";

        $argArrary; // null for now

        $stmt = $db->prepare($query);

        if($stmt->execute()) {
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $classList[] = $result;
            }
            return json_encode($classList);
        }
        else {
            return json_encode(array("err" => "Error connecting to database"));
        }
    }