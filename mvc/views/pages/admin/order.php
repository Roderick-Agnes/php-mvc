<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders Datatable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Food list</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>Customer</th>
                            <th>Create from</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($data['listOrder'] as $key => $item) {
                            $foodList = json_decode($item['foodList'], true);
                            $showList = "<p>";
                            foreach ($foodList as $food) {
                                $showList .= ((int)($food['key']) + 1) . " - " . $food['foodName'] . ", price: " . number_format($food['price'], 0, '', '.') . " vnd, quantity: " . $food['quantity'] . ", total: " . number_format($food['totalPrice'], 0, '', '.') . " vnd</p>";
                            }
                            echo '<tr id="tr-item-' . $item['id'] . '">';
                            echo '<td>' . $item['id'] . '</td>';
                            echo '<td>' . $showList . '</td>';
                            echo '<td>' . number_format($item['totalPrice'], 0, '', ',') . ' vnd</td>';
                            echo ($item['paymentStatus'] == 0) ? '<td><span class="badge bg-danger text-white">null</span></td>' : '<td><span class="badge bg-success text-white">Success</span></td>';
                            echo '<td>' . $item['paymentMethod'] . '</td>';
                            echo '<td>' . $item['customerName'] . '</td>';
                            echo '<td>' . $item['createDate'] . '</td>';

                            echo "<td><a href='javascript:void(0)' onclick='handleDeleteOrderById(\"" . $item['id'] . "\")' class='btn btn-outline-danger btn-sm btn-rounded'>Delete</a></td>";
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