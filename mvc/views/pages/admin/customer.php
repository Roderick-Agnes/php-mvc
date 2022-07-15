<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Datatable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-outline-success mt-2 mb-2" data-toggle="modal" data-target="" onclick="showModalAddCustomer()">Add new</button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($data['listCustomer'] as $key => $cus) {
                            $gender = $cus['gender'] == 0 ? 'Male' : 'Female';
                            echo '<tr id="tr-item-' . $cus['id'] . '">';
                            echo '<td>' . $cus['id'] . '</td>';
                            echo '<td>' . $cus['firstname'] . '</td>';
                            echo '<td>' . $cus['lastname'] . '</td>';
                            echo '<td>' . $cus['email'] . '</td>';
                            echo '<td>' . substr($cus['address'], 0, 50) . '...' . '</td>';
                            echo '<td>' . $cus['phone'] . '</td>';
                            echo '<td>' . $gender . '</td>';
                            echo '<td>' . $cus['username'] . '</td>';
                            echo '<td>' . $cus['password'] . '</td>';
                            echo "<td><a href='javascript:void(0)' onclick='handleShowModalUpdateCustomer(" . $cus['id'] . ")' class='btn btn-outline-primary btn-sm btn-rounded'>Edit</a></td><td><a href='javascript:void(0)' onclick='handleDeleteCustomerById(" . $cus['id'] . ")' class='btn btn-outline-danger btn-sm btn-rounded'>Delete</a></td>";
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