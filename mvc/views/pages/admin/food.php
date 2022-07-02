<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Food Datatable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-outline-success mt-2 mb-2" data-toggle="modal" data-target="#exampleModal" onclick="">Add new</button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($data['listFood'] as $key => $food) {
                            echo '<tr id="tr-item-' . $food['id'] . '">';
                            echo '<td>' . $food['id'] . '</td>';
                            echo '<td>' . $food['foodName'] . '</td>';
                            echo '<td>' . Category::getCategoriesById($food['categoryId'])['categoryName'] . '</td>';
                            echo '<td>' . number_format($food['price'], 0, '', ',') . ' vnd</td>';
                            echo '<td>' . substr($food['foodDescription'], 0, 50) . '...' . '</td>';
                            echo '<td>' . "<img src='" . $base_url . "public/assets/images/food/" . $food['foodImage'] . "' width='100rem' height='auto' class='' alt='{$food['foodImage']}'>" . '</td>';
                            echo "<td><a href='javascript:void(0)' onclick='handleShowModalUpdateFood(" . $food['id'] . ",\"" . Category::getCategoriesById($food['categoryId'])['categoryName'] . "\")' class='btn btn-outline-primary btn-sm btn-rounded'>Edit</a></td><td><a href='javascript:void(0)' onclick='handleDeleteFoodById(" . $food['id'] . ")' class='btn btn-outline-danger btn-sm btn-rounded'>Delete</a></td>";
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