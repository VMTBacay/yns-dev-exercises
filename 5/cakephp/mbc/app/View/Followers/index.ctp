<?= $this->element('navbar');
?>
<div class="page-wrapper" style="background-image:url(/app/webroot/img/home_back.jpg);">
    <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor"><b>Follow your own PASSION</b></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Follow your own PASSION</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Follow Someone?</h4>
                                    <div class="table-responsive m-t-0 hide_border">
                                        <table id="myTable_search" class="table table-bordered table-striped hide_border">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Fullname</th>
                                                    <th>Date Started</th>
                                                    <th>Email</th>
                                                    <th>Follow</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $this->requestAction(['controller'=>'users', 'action'=>'allUsers'], ['return']); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-2"></div>
                </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#myTable_search').DataTable();
    $('#myTable_follower').DataTable();
    $('#myTable_following').DataTable();
});
</script>