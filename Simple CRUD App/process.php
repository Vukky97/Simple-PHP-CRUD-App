<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'simplierDb') or die(mysqli_error($mysqli));

$title = '';
$description = '';
$contactName = '';
$contactEmail = '';
$status = '';
$update = false;
$id = 0;
$show_modal = false;
//$amountPerPage = 3;


// CREATE: Add a new project to projects
if (isset($_POST['save-btn'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $contactName = $_POST['contactName'];
    $contactEmail = $_POST['contactEmail'];

    $mysqli->query("INSERT INTO projects (title, description, status, ownerName, ownerEmail) VALUES('$title','$description','$status','$contactName','$contactEmail') ") or
        die($mysqli->error);

    //$_SESSION['message'] = "Projekt hozzáadva.";
    $_SESSION['message'] = "Projekt hozzáadva.";
    $_SESSION['msg-type'] = "success";

    header("location: projects.php");
}

// DELETE: Delete the choosen project from projects
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM projects WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "A projekt törlésre került.";
    $_SESSION['msg-type'] = "danger";

    header("location: projects.php");
}

// EDIT: Get the values of the choosen id and paste these to the form's input fields
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM projects WHERE id=$id") or die(mysqli_error($mysqli));
    if (!is_null($result)) {
        $row = $result->fetch_array();
        $title = $row['title'];
        $description = $row['description'];
        $status = $row['status'];
        $contactName = $row['ownerName'];
        $contactEmail = $row['ownerEmail'];
    }
    $show_modal = true;
}


// UPDATE: Updates the choosen project, using hidden id
if (isset($_POST['update-btn'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $contactName = $_POST['contactName'];
    $contactEmail = $_POST['contactEmail'];


    $mysqli->query("UPDATE projects SET title='$title', description='$description', status='$status', ownerName='$contactName', ownerEmail='$contactEmail' WHERE id=$id") or
        die(mysqli_error($mysqli));

    $_SESSION['message'] = "Sikeres módosítás";
    $_SESSION['msg_type'] = "sucess";

    header('location: projects.php');
}
