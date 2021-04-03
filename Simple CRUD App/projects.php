<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management Software - Cheap Version</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg-type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="modal fade" id="projectAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Projekt hozzáadása</h1>
                </div>
                <div class="modal-body">
                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="title">Cím</label>
                                <input type="text" id="title" class="form-control" name="title" required minlength="3" maxlength="150" value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="description">Leírás</label>
                                <textarea id="description" class="form-control" rows="3" name="description" required><?php echo $description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="status">Státusz</label>
                                <select id="status" class="form-control" name="status">
                                    <option <?php if ($status == 'Fejlesztésre vár') echo 'selected'; ?>>Fejlesztésre vár</option>
                                    <option <?php if ($status == 'Folyamatban') echo 'selected'; ?>>Folyamatban</option>
                                    <option <?php if ($status == 'Kész') echo 'selected'; ?>>Kész</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="contactName">Kapcsolattartó neve</label>
                                <input type="text" id="contactName" class="form-control" name="contactName" required minlength="3" maxlength="150" value="<?php echo $contactName; ?>">

                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col">

                                <label for="contactEmail">Kapcsolattartó e-mail címe</label>
                                <input type="email" id=" contactEmail" class="form-control" name="contactEmail" required minlength="3" maxlength="150" value="<?php echo $contactEmail; ?>">
                            </div>
                        </div>
                        <div class="form-row mx-auto d-block">
                            <div class="form-group">
                                <?php if ($update == true) : ?>
                                    <label for="update"></label>
                                    <button type="submit" id="update" class="btn btn-primary form-control" name="update-btn">Módosítás</button>
                                <?php else : ?>
                                    <label for="save"></label>
                                    <button type="submit" id="save" class="btn btn-primary form-control" name="save-btn">Mentés</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container justify-content-center">
        <div class="py-3">
            <button type="button" class="btn btn-primary mx-auto d-block" data-toggle="modal" data-target="#projectAddModal">
                Új projekt hozzáadása
            </button>
        </div>

        <div class="container">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'simplierDb') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM projects") or die($mysqli->error);
            ?>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class=""><?php echo $row['title']; ?></h5>
                            <p class=""><?php echo $row['status']; ?></p>
                        </div>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <div class="d-flex">
                            <p class="mr-2"><?php echo $row['ownerName']; ?></p>
                            <p class=""><?php echo "(" . $row['ownerEmail'] . ")"; ?></p>
                        </div>
                        <a href="projects.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Szerkesztés</a>
                        <a href=" process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Törlés</a>

                        <?php if ($show_modal) : ?>
                            <script>
                                $('#projectAddModal').modal('show');
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>

            <div class="py-3">
                <button type="button" class="btn btn-primary mx-auto d-block" data-toggle="modal" data-target="#projectAddModal">
                    Új projekt hozzáadása
                </button>
            </div>
        </div>
    </div>

</body>

</html>