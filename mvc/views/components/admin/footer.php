<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap core JavaScript-->

<script src="<?php echo $base_url . $assets_url ?>vendor/jquery/jquery.min.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $base_url . $assets_url ?>vendor/bootstrap/js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>


<!-- Core plugin JavaScript-->
<script src="<?php echo $base_url . $assets_url ?>vendor/jquery-easing/jquery.easing.min.js?v=<?php echo time(); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo $base_url . $assets_url ?>js/sb-admin-2.min.js?v=<?php echo time(); ?>"></script>




<!-- Page level custom scripts -->
<!-- <script src="<php echo $base_url . $assets_url ?>js/demo/chart-area-demo.js"></script>
<script src="<php echo $base_url . $assets_url ?>js/demo/chart-pie-demo.js"></script> -->
<!-- Page level plugins -->
<script src="<?php echo $base_url . $assets_url ?>vendor/chart.js/Chart.min.js"></script>

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
    $(document).ready(function(e) {
        const foodUrl = new URL("<?php echo $base_url . 'admin/food' ?>");

        if (window.location.href == foodUrl.toString()) {
            handleUpdateCategory();
            handleUpdateFood();
        }

    });


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
                                    <option value='` + item.categoryId + `'>` + categoryName + `</option>` +
                        +
                        `<?php
                            if (array_key_exists('listCategory', $data)) {
                                foreach ($data['listCategory'] as $key => $item) {
                                    echo "<option value='" . $item['id'] . "'>" . $item['categoryName'] . "</option>";
                                }
                            }

                            ?>` + `
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
            text: "You will not be able to recover this item!",
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

    // handle order
    const handleDeleteOrderById = (id) => {
        const swalWithBootstrapButtons = getSwalInstance();
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url ?>" + "Admin/DeleteOrderById",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function await (data) {
                        const res = JSON.parse(data);
                        if (res.status_code == '200') {
                            handleDeleteRowDataTable(id);
                        }
                        console.log('delete order: ' + res.status);
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Order item has been deleted.',
                    'success'
                );

                //show toaster
                tata.success(`Delete order`, `Delete order with id: ` + id + ` successfully`, {
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
    const handleChangeStatusOrderById = (id) => {
        const buttonChange = document.getElementById('changerButton-' + id);
        const buttonDel = document.getElementById('buttonChange-' + id);

        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/ChangeStatusOrder",
            cache: false,
            data: {
                id: id
            },
            success: function(response) {
                const res = JSON.parse(response);
                console.log('status: ' + res);
                if (res.status == 'Ok') {
                    window.location.reload();
                }
            }
        });
    }
    const handleLogout = () => {
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/Logout",
            cache: false

        });
        window.location.href = "<?php echo $base_url ?>" + "admin/login";
    }
</script>
<!-- //chart resize -->
<!-- <script>
    $(window).load(function() {
        $(window).resize(function() {
            $('#myAreaChart').closest('.chart-container').css('width', $('#myAreaChart').closest('section').width());
        });
    });
</script> -->

<script type="text/javascript">
    $(document).ready(function(e) {
        const dashboarhUrl = new URL("<?php echo $base_url . 'admin' ?>");

        if (window.location.href == dashboarhUrl.toString()) {
            autoLoadData();
            //countDown(5);

        }
    });
    const FormatMoney = (money) => {
        return money.toLocaleString('it-IT', {
            style: 'currency',
            currency: 'VND'
        });
    }
    const countDown = (time) => {
        var timeleft = time;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
            }
            timeleft -= 1;
            if (timeleft == 0) {
                autoLoadData();
                timeleft = time;
            }
        }, 1000);

    }



    const FilterData = (order_data, typeDefault = 'month', timeDefault = null) => {
        var defaultDate = new Date();
        var endDate = new Date("2022-07-14 00:00:00");

        var resultProductData = order_data.filter(a => {
            var date = new Date(a.createDate);
            if (typeDefault == 'month') {
                if (timeDefault == null) {
                    return (date.getMonth() + 1 == defaultDate.getMonth() + 1);
                } else {
                    return (date.getMonth() + 1 == timeDefault);
                }
            } else if (typeDefault == 'year') {
                if (timeDefault == null) {
                    return (date.getFullYear() == defaultDate.getFullYear());
                } else {
                    return (date.getFullYear() == timeDefault);
                }

            }
        });
        return resultProductData;
    }

    const RandomRGBA = (defaultColorValue) => {
        var o = Math.round,
            r = Math.random,
            s = 255;
        return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + defaultColorValue + ')';
    }
    const date = new Date();

    let chartConfigs = {
        title: 'Order Management In ' + (date.toLocaleString('en-us', {
            month: 'short',
            year: 'numeric'
        })),
        labels: [],
        data: [],
        backgroundColor: [],
        borderColor: [],
    };

    let renderBarChart = () => {

        if (localStorage.getItem('chart')) {
            const data = JSON.parse(localStorage.getItem('chart'));
            console.log(data);
            let foods = [];
            let arrayFood = [];
            data.map(item => {
                const foodList = JSON.parse(item.foodList);
                foodList.map(food => {
                    const f = {
                        orderId: item.id,
                        key: food.id,
                        foodName: food.foodName,
                        quantity: food.quantity,
                        price: food.price
                    }
                    foods.push(f);

                });
            });

            foods.map(item => {
                const newFood = foods.filter(x => x.key === item.key);
                foods = foods.filter(i => i.key !== item.key);
                if (newFood.length > 0) {
                    arrayFood.push(newFood);
                }



                //console.log();
            });
            // console.log(arrayFood);
            let pr = 0;
            arrayFood.map(item => {
                item.map(x => {
                    pr += parseInt(x.quantity * x.price);
                });
                chartConfigs.labels.push(item[0].foodName);
                chartConfigs.data.push(pr);
                chartConfigs.backgroundColor.push(RandomRGBA(0.2));
                chartConfigs.borderColor.push(RandomRGBA(1));
                pr = 0;
            });




        }
        const myAreaChart = document.getElementById('myBarChart').getContext('2d');

        let myChart = new Chart(myAreaChart, {
            type: 'bar',
            data: {
                labels: chartConfigs.labels,
                datasets: [{
                    label: chartConfigs.title,
                    data: chartConfigs.data,
                    backgroundColor: chartConfigs.backgroundColor,
                    borderColor: chartConfigs.borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'VND'
                        }
                    }],
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toLocaleString('it-IT', {
                                style: 'currency',
                                currency: 'VND'
                            });
                        }
                    }
                }
            }
        });

    }
    const autoLoadData = () => {
        renderBarChart();
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/GetEarningMonthly",
            cache: false,
            success: function(response) {
                const order_data = JSON.parse(response);
                const monthEarner = document.getElementById('monthEarner');
                const yearEarner = document.getElementById('yearEarner');
                const paymentStatus = document.getElementById('percentPayment');
                const percentComplete = document.getElementById('percentComplete');
                const orderNumber = document.getElementById('orderNumber');


                let monthEarning = 0;
                let yearEarning = 0;
                const currentDate = new Date();

                let ordersByMonth = FilterData(order_data).filter(a => {

                    if (a.paymentStatus != 0) {
                        console.log('money: ' + a.totalPrice);
                        monthEarning += parseInt(a.totalPrice);
                        return this;
                    }

                });

                localStorage.setItem('chart', JSON.stringify(ordersByMonth));

                const allOrderLength = FilterData(order_data, 'year', currentDate.getFullYear()).length;

                let ordersByYear = FilterData(order_data, 'year', currentDate.getFullYear()).filter(a => {
                    if (a.paymentStatus != 0) {
                        yearEarning += parseInt(a.totalPrice);
                        return this;
                    }
                });

                const percentPayment = ordersByYear.length / allOrderLength * 100;
                // inner html
                monthEarner.innerHTML = FormatMoney(monthEarning);
                yearEarner.innerHTML = FormatMoney(yearEarning);
                paymentStatus.innerHTML = percentPayment.toFixed(2) + '%';
                percentComplete.style.width = percentPayment + '%';
                percentComplete.setAttribute("aria-valuenow", percentPayment);

                orderNumber.innerHTML = allOrderLength + ' orders';
                //console.log(ordersByMonth)

            }
        });
    }

    function addDataChart(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }

    function removeDataChart(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });
        chart.update();
    }
</script>

<script>
    const showModalAddCustomer = () => {
        //show modal
        $('#AddCustomerModal').modal('show');
    }

    const handleCreateCustomer = () => {
        const firstname = document.getElementById('firstname');
        const lastname = document.getElementById('lastname');
        const email = document.getElementById('email');
        const address = document.getElementById('address');
        const phone = document.getElementById('phone');
        const gender = document.getElementById('gender');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        $.ajax({
            url: '<?php echo $base_url ?>' + 'auth/createAccount',
            type: "POST",
            data: {
                firstname: firstname.value,
                lastname: lastname.value,
                email: email.value,
                address: address.value,
                phone: phone.value,
                gender: gender.value,
                username: username.value,
                password: password.value
            },
            cache: false,
            success: function(data) {
                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    window.location.reload();
                } else {
                    tata.error(`Delete customer`, res.message, {
                        position: 'tr'
                    });
                }
            }
        });
    }
    const handleDeleteCustomerById = (id) => {
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
                    url: '<?php echo $base_url ?>' + 'Admin/DeleteCustomer',
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        let res = JSON.parse(data);
                        if (res.status_code == '200') {
                            handleDeleteRowDataTable(id);
                        } else {
                            //show toaster
                            tata.error(`Delete customer`, `Delete customer with id: ` + id + ` failed`, {
                                position: 'tr'
                            });
                        }
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'customer has been deleted.',
                    'success'
                );

                //show toaster
                tata.success(`Delete customer`, `Delete customer with id: ` + id + ` successfully`, {
                    position: 'tr'
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'customer is safe :)',
                    'error'
                )
            }
        })

    }
    const handleShowModalUpdateCustomer = (id) => {
        const foodUpdateForm = document.getElementById('updateCustomerForm');
        let item = {};
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/GetCustomer",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {

                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    item = res.data;
                    let gender = item.gender === 0 ? `<option value="0" selected>Male</option><option value="1">Female</option>` : `<option value="0">Male</option><option value="1" selected>Female</option>`;
                    foodUpdateForm.innerHTML = `
                    <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">ID:</span>
                        <input type="text" class="form-control" name="customerId" id="customerId" value="` + item.id + `" aria-describedby="basic-addon3" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Firstname:</span>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="` + item.firstname + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Lastname:</span>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="` + item.lastname + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Email:</span>
                        <input type="text" class="form-control" name="email" id="email" value="` + item.email + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Address:</span>
                        <input type="text" class="form-control" name="address" id="address" value="` + item.address + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Phone:</span>
                        <input type="text" class="form-control" name="phone" id="phone" value="` + item.phone + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Gender:</span>
                        <select name="gender" id="gender" class="form-control">
                            ` +
                        gender +
                        `
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Username:</span>
                        <input type="text" class="form-control" name="username" id="username" value="` + item.username + `" aria-describedby="basic-addon3" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Password:</span>
                        <input type="password" class="form-control" name="password" id="password" value="` + item.password + `" aria-describedby="basic-addon3">
                    </div>
                </div>
                    `;
                    //show modal
                    $('#updateCustomerModal').modal('show');
                }

            }
        });
    }

    $("#updateCustomer").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo $base_url ?>' + 'Admin/UpdateCustomer',
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
                } else {
                    //show toaster
                    tata.error(`Customer`, res.message, {
                        position: 'tr'
                    });
                    console.log(res.message);
                }
            }
        });
    }));
    const showModalAddAdminAccount = () => {
        //show modal
        $('#AddAdminAccountModal').modal('show');
    }

    const handleCreateAdminAccount = () => {
        const fullname = document.getElementById('fullnameAdminAccount');
        const username = document.getElementById('usernameAdminAccount');
        const password = document.getElementById('passwordAdminAccount');
        $.ajax({
            url: '<?php echo $base_url ?>' + 'admin/CreateAdminAccount',
            type: "POST",
            data: {
                fullname: fullname.value,
                username: username.value,
                password: password.value
            },
            cache: false,
            success: function(data) {
                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    window.location.reload();
                } else {
                    tata.error(`Admin account`, res.message, {
                        position: 'tr'
                    });
                }
            }
        });
    }
    const handleDeleteAdminAccountById = (id) => {
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
                    url: '<?php echo $base_url ?>' + 'Admin/DeleteAdminAccount',
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        let res = JSON.parse(data);
                        if (res.status_code == '200') {
                            handleDeleteRowDataTable(id);
                        } else {
                            //show toaster
                            tata.error(`Delete admin account`, `Delete admin account with id: ` + id + ` failed`, {
                                position: 'tr'
                            });
                        }
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Admin account has been deleted.',
                    'success'
                );

                //show toaster
                tata.success(`Delete admin account`, `Delete admin account with id: ` + id + ` successfully`, {
                    position: 'tr'
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'customer is safe :)',
                    'error'
                )
            }
        })

    }
    const handleShowModalUpdateAdminAccount = (id) => {
        const updateAdminAccountForm = document.getElementById('updateAdminAccountForm');
        let item = {};
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url ?>" + "Admin/GetAdminAccount",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {

                let res = JSON.parse(data);
                if (res.status_code == '200') {
                    item = res.data;
                    updateAdminAccountForm.innerHTML = `
                    <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">ID:</span>
                        <input type="text" class="form-control" name="accId" id="accId" value="` + item.id + `" aria-describedby="basic-addon3" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Firstname:</span>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="` + item.fullname + `" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Username:</span>
                        <input type="text" class="form-control" name="username" id="username" value="` + item.username + `" aria-describedby="basic-addon3" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Password:</span>
                        <input type="password" class="form-control" name="password" id="password" value="` + item.password + `" aria-describedby="basic-addon3">
                    </div>
                </div>
                    `;
                    //show modal
                    $('#updateAdminAccountModal').modal('show');
                }

            }
        });
    }
    $("#updateAdminAccount").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo $base_url ?>' + 'Admin/UpdateAdminAccount',
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
                } else {
                    //show toaster
                    tata.error(`Customer`, res.message, {
                        position: 'tr'
                    });
                    console.log(res.message);
                }
            }
        });
    }));
</script>