<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style> -->

<head></head>

<body>
    <div class="container">
        <div class="table-responsive">
        <h1><?= $data['title'] ?></h1>

        <p>name : <?= $data['name'] ?></p>

        <p>Team list : </p>

        <?php if (isset($data['team'])) {    ?>
            <table class="table " style="width: 50%" aria-describedby="the team list">
                <tr>
                    <th scope="col"> ID </th>
                    <th scope="col"> Role </th>
                    <th scope="col"> name </th>
                    <th scope="col"> phone </th>
                </tr>
                <?php $team = $data['team'] ?>

                <tr class="bg-success text-white-50">
                    <td><?= $team->id ?> </td>
                    <td><?= $team->role ?></td>
                    <td><?= $team->fullname ?></td>
                    <td><?= $team->mobile ?></td>
                </tr>

            <?php } else { ?>
                <p> <?=$data['error'] ?></p>
            <?php } ?>

            </table>
        </div>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>