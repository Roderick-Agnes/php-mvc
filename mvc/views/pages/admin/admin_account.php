<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Account Datatable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-outline-success mt-2 mb-2" data-toggle="modal" data-target="" onclick="showModalAddAdminAccount()">Add new account</button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($data['listAdminAccount'] as $key => $acc) {
                            echo '<tr id="tr-item-' . $acc['id'] . '">';
                            echo '<td>' . $acc['id'] . '</td>';
                            echo '<td>' . $acc['fullname'] . '</td>';
                            echo '<td>' . $acc['username'] . '</td>';
                            echo '<td>' . $acc['password'] . '</td>';
                            echo "<td><a href='javascript:void(0)' onclick='handleShowModalUpdateAdminAccount(" . $acc['id'] . ")' class='btn btn-outline-primary btn-sm btn-rounded'>Edit</a></td><td><a href='javascript:void(0)' onclick='handleDeleteAdminAccountById(" . $acc['id'] . ")' class='btn btn-outline-danger btn-sm btn-rounded'>Delete</a></td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->