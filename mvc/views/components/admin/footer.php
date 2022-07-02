<!-- Bootstrap core JavaScript-->
<script src="<?php echo $base_url . $assets_url ?>vendor/jquery/jquery.min.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>vendor/bootstrap/js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>


<!-- Core plugin JavaScript-->
<script src="<?php echo $base_url . $assets_url ?>vendor/jquery-easing/jquery.easing.min.js?v=<?php echo time(); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo $base_url . $assets_url ?>js/sb-admin-2.min.js?v=<?php echo time(); ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo $base_url . $assets_url ?>vendor/chart.js/Chart.min.js?v=<?php echo time(); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo $base_url . $assets_url ?>js/demo/chart-area-demo.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>js/demo/chart-pie-demo.js?v=<?php echo time(); ?>"></script>

<script src="<?php echo $base_url . $assets_url ?>vendor/datatables/jquery.dataTables.min.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>vendor/datatables/dataTables.bootstrap4.min.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>js/demo/datatables-demo.js?v=<?php echo time(); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>public/assets/js/tata.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>ckeditor/ckeditor.js"></script>
<script>
    var editor = CKEDITOR.replace('description');
    // CKFinder.setupCKEditor(editor);
</script>
<script type="text/javascript">
    const handleClearTextArea = () => {
        document.getElementById('foodDesc').value = ''
    }

    // const handleChangeToPage = (pageName) => {
    //     const rootContent = document.getElementById('child-page');
    //     const content = document.getElementById('child-content');
    //     if (pageName === 'foods') {
    //         // const url = '<php echo $base_url ?>' + controller + ((action === 'index') ? '' : '/' + action);
    //         // history.pushState({
    //         //    page: page
    //         // }, 'this is a food page', url);

    //         content.remove();
    //         rootContent.innerHTML = `
    //             <div id="child-content"></div>
    //         `;
    //         //document.getElementById('child-content').innerHTML = `<php require('./mvc/views/pages/admin/food.php') ?>`;
    //     }
    // }
    const handleDeleteRowDataTable = (id) => {
        const trFood = document.getElementById('tr-item-' + id);
        trFood.remove();
    }
    const getSwalInstance = () => {
        return Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
    }

    const handleDeleteFoodById = async (id) => {
        const rootContent = document.getElementById('child-page');
        const content = document.getElementById('child-content');

        const swalWithBootstrapButtons = getSwalInstance();

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this cart!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url ?>" + "Admin/DeleteFoodById",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function await (data) {
                        const res = JSON.parse(data);
                        if (res.status_code == '200') {
                            handleDeleteRowDataTable(id);
                        }
                        console.log('delete food: ' + res.status);
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your product has been deleted.',
                    'success'
                );

                //show toaster
                tata.success(`Delete food`, `Delete food with id: ` + id + ` successfully`, {
                    position: 'tr'
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your product is safe :)',
                    'error'
                )
            }
        })


    }
    const handleShowModalUpdateFood = (id, categoryName) => {
        const foodUpdateForm = document.getElementById('foodUpdateForm');
        let item = {};
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/GetFoodById",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {

                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    item = res.data;
                    foodUpdateForm.innerHTML = `
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Name:</span>
                                <input type="text" name="foodId" id="foodId" value="` + id + `" hidden>
                                <input type="text" class="form-control" name="foodName"  id="foodName" value="` + item.foodName + `" aria-describedby="basic-addon3">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Category</label>
                                <select class="form-select form-control" name="categoryId" id="selecterCategory">
                                    <option value='` + item.categoryId + `'>` + categoryName + `</option>
                                    <?php
                                    foreach ($data['listCategory'] as $key => $item) {
                                        echo "<option value='" . $item['id'] . "'>" . $item['categoryName'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Price:</span>
                                <input type="number" class="form-control" name="price" id="price" value="` + item.price + `" aria-describedby="basic-addon3">
                            </div>

                            <textarea id="foodDesc" name='descriptionFood' class="form-control">` + item.foodDescription + `</textarea>

                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="foodImage">Image</label>
                                <input type="text" class="form-control" name="foodImage" value="` + item.foodImage + `" hidden>
                                <input type="file" class="form form-control" name="image" id="foodImage" accept="image/*" onchange="loadFile('showUpdateFoodImage')" value="<?php echo $base_url ?>public/assets/images/food/` + item.foodImage + `">
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <img id="showUpdateFoodImage" width="150rem" height="auto"  src="<?php echo $base_url ?>public/assets/images/food/` + item.foodImage + `" alt="food image" />
                                
                            </div>
                        </div>
                    `;

                    //set CKEDITOR
                    CKEDITOR.replace('descriptionFood');
                    //show modal
                    $('#editFoodModal').modal('show');
                }

            }
        });

    }
    const handleUpdateFood = () => {
        $("#updateFood").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $base_url ?>' + 'admin/UpdateFoodById',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {

                },
                success: function(data) {
                    let res = JSON.parse(data);
                    if (res.status_code == '200') {
                        window.location.reload();
                    }
                }
            });
        }));
    }
    const loadFile = (id) => {
        const output = document.getElementById(id);
        output.setAttribute('src', '');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };


    //Category
    const handleDeleteCategoryById = (id) => {
        const swalWithBootstrapButtons = getSwalInstance();
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this cart!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url ?>" + "Admin/DeleteCategoryById",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function await (data) {
                        const res = JSON.parse(data);
                        if (res.status_code == '200') {
                            handleDeleteRowDataTable(id);
                        }
                        console.log('delete category: ' + res.status);
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your category has been deleted.',
                    'success'
                );

                //show toaster
                tata.success(`Delete category`, `Delete category with id: ` + id + ` successfully`, {
                    position: 'tr'
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your product is safe :)',
                    'error'
                )
            }
        })
    }
    const handleShowModalUpdateCategory = (id) => {
        const categoryUpdateForm = document.getElementById('categoryUpdateForm');
        let item = {};
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/GetCategoryById",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {

                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    item = res.data;
                    categoryUpdateForm.innerHTML = `
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Name:</span>
                                <input type="text" class="form-control" name="categoryId" value="` + id + `" hidden>
                                <input type="text" class="form-control" value="` + item.categoryName + `" name="categoryName" id="foodName" aria-describedby="basic-addon3">
                            </div>

                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="categoryImage">Image</label>
                                <input type="text" class="form-control" name="categoryImage" value="` + item.categoryImage + `" hidden>
                                <input type="file" class="form form-control" name="image" id="categoryImage" accept="image/*" onchange="loadFile('showUpdateCategoryImage')">
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <img id="showUpdateCategoryImage" width="150rem" height="auto" src="<?php echo $base_url ?>public/assets/images/category/` + item.categoryImage + `" alt="category image" />
                            </div>
                        </div>
                    `;

                    //show modal
                    $('#updateCategoryModal').modal('show');
                }

            }
        });
    }
    const handleUpdateCategory = () => {
        $("#updateCategory").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $base_url ?>' + 'admin/UpdateCategoryById',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    let = item = {};
                    let res = JSON.parse(data);
                    if (res.status_code == '200') {
                        window.location.reload();

                    }
                }
            });
        }));
    }

    $(document).ready(function(e) {
        handleUpdateCategory();
        handleUpdateFood();
    });
</script>

<!-- handle order -->
<script type="text/javascript">
    const handleDeleteOrderById = (id) => {

    }
</script>