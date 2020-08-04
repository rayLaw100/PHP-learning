<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<?php require APPROOT . '/views/inc/header.php'; ?>


<head>
    <title>Php test - Update page </title>
    <h2> Update team </h2>

</head>
<?php
$team = $data['team'];
var_dump($data);
?>

<body>
    <div class="container">
        <form action="<?= URLROOT ?>pages/editTeam" id="frm" method="post">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Notice</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="role" class="mr-2">Role</label> <span id="role-err" class="text-danger"></span>
                                <input type="text" class="form-control" id="role" name="role" value="<?= $team->role ?>" maxlength="200" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="fullname" class="mr-2">Full name</label> <span id="fullname-err" class="text-danger"></span>
                                <textarea name="fullname" id="fullname" class="form-control mb2" required><?= $team->fullname ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mobile" class="mr-2">Phone</label> <span id="mobile-err" class="text-danger"></span>
                                <input name="mobile" id="mobile" class="form-control" required value="<?= $team->mobile ?>">
                            </div>

                            <div class="form-group text-center mt-3">
                                
                                <input type="submit" value="Edit team" class="btn btn-success" id="btn-edit">
                                <button type="button" class="btn btn-outline-secondary" id="btn-cancel">Cancel</button>
                                <input type="hidden" id="id" name="id" value="<?= $team->id ?>">
                                <input type="hidden" id="act" name="act" value="DO-UPDATE">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

</body>



<?php require APPROOT . '/views/inc/footer.php'; ?>

</html>
<script>
    $("#btn-cancel").click(function(e) {
        // e.preventDefault;
        $("#act").val("DO-CANCEL");
        $("#frm").submit();
    });
</script>