<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Category Datatable</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-outline-success mt-2 mb-2" data-toggle="modal" data-target="#createCategoryModal" onclick="">Add new</button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="categoryTbody">
                        <?php


                        foreach ($data['listCategory'] as $key => $item) {
                            echo '<tr id="tr-item-' . $item['id'] . '">';
                            echo '<td>' . $item['id'] . '</td>';
                            echo '<td>' . $item['categoryName'] . '</td>';
                            echo '<td>' . "<img src='" . $base_url . "public/assets/images/category/" . $item['categoryImage'] . "' width='100rem' height='auto' class='' alt='{$item['categoryName']}'>" . '</td>';
                            echo "<td><a href='javascript:void(0)' onclick='handleShowModalUpdateCategory(" . $item['id'] . ")' class='btn btn-outline-primary btn-sm btn-rounded'>Edit</a></td><td><a href='javascript:void(0)' onclick='handleDeleteCategoryById(" . $item['id'] . ")' class='btn btn-outline-danger btn-sm btn-rounded'>Delete</a></td>";
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