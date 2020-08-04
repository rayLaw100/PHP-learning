<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>

<head>
    <title>PHP test index</title>
</head>

<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-12  mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1><?= $data['title'] ?></h1>

                        <p>name : <?= $data['name'] ?></p>

                        <p>Team list : </p>

                        <?php if (isset($data['team'])) {     ?>
                            <table class="table table-bordered table-striped mx-auto" aria-describedby="the team list">
                                <tr>
                                    <th scope="col" style="text-align:center"> ID </th>
                                    <th scope="col" style="text-align:center"> Role </th>
                                    <th scope="col" style="text-align:center"> Name </th>
                                    <th scope="col" style="text-align:center"> Phone </th>
                                    <th scope="col" style="text-align:center"> Go To <br>Edit</th>
                                </tr>
                                <?php foreach ($data['team'] as $team) { var_dump($team);  ?>

                                    <tr>
                                        <td style="text-align:center"><?= $team->id ?> </td>
                                        <td><?= $team->role ?></td>
                                        <td><?= $team->fullname ?></td>
                                        <td><?= $team->mobile ?></td>
                                        <td style="text-align:center"><a href="<?= URLROOT ?>pages/editTeam/<?= $team->id ?>" class="text-dark"><button> Edit </button></a></td>
                                        <td>
                                            <span data-toggle="tooltip" title="Delete this notice">
                                                <a href="#" class="text-dark" link="del" nid="<?= $team->id ?>">Delete</i></a>
                                            </span>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>
                        <?php } ?>
                    </div>
                    <div class="card-body mx-auto" style="width:60%">
                        <div>
                            <form action="<?= URLROOT ?>pages/searchById" id="frm_serach" method="post">
                                <div class="form-group mb-2 mt-2 card-body" id="serach"> Search (Id) :
                                    <input type="text" name="search-id" id="search-id" maxlength="10">
                                    <input type="hidden" name="act" id="act" value="DO-search">
                                    <input type="submit" value="Search team" class="btn btn-primary" id="btn-search">

                                </div>
                            </form>
                            <form action="<?= URLROOT ?>pages/addTeam" id="frm_add" method="post">
                                <div class="form-group card-body " id="add"> Create New Team : <br>
                                    <label for="Id"><b> Id :</b></label>
                                    <input class="form-control " type="text" name="new_id" id="new_id" maxlength="10" required>
                                    <label for="Name"><b> Name : </b></label>
                                    <input class="form-control " type="text" name="new_name" id="new_name" maxlength="200" required>
                                    <label for="Mobile"><b> Phone : </b></label>
                                    <input class="form-control " type="text" name="new_mobile" id="new_mobile" maxlength="50" required>
                                    <label for="Role"><b> Role : </b></label>
                                    <input class="form-control " type="text" name="new_role" id="new_role" maxlength="200" required>
                                    <input type="hidden" name="act" id="act" value="DO-add">
                                    <div style="text-align: center">
                                        <input type="submit" value="Add team" class="mb-2 mt-2 btn btn-danger vertical-center" id="btn-add">
                                    </div>
                                </div>
                            </form>
                            <form action="<?= URLROOT ?>pages/deleteTeam" id="frm_del" method="post">
                                <div class="form-group mb-2 mt-2 card-body" id="delete"> Delete Team (Id) :
                                    <input type="text" name="del_id" id="del_id" maxlength="10">
                                    <input type="hidden" name="act" id="act" value="DO-delete">
                                    <input type="submit" value="Delete team" class="btn btn-primary" id="btn-delete">

                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="hidden" name="act" id="act" value="">
                </div>
            </div>
        </div>
    </div>


    <!-- Delete form -->
    <form action="<?= URLROOT ?>pages/delTeam" id="frm_del" method="post">
        <input type="hidden" id="act" name="act" value="DO-DELETE">
        <input type="hidden" id="teamid" name="teamid" value="">
    </form>

    <!-- Modal dialog -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="deleteModalTitle">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aira-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btn-modal-yes">Yes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>


<footer>
    <br>
    <h4 style="text-align: center;"><b>
            < --- End --->
        </b> </h4>
</footer>

</html>

<script>
    $(document).ready(function(e) {
        // Initialize tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('a[link=del]').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('nid');
        $("#teamid").val(id);
        var modal = $("#deleteModal");
        modal.find('.modal-body p').html('Are you sure to delete this?');
        modal.modal('toggle');
    });

    $("#btn-modal-yes").click(function(e) {
        e.preventDefault();
        $("#frm_del").submit();
    });
</script>