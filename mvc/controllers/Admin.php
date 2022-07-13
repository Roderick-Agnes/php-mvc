<?php
//require models
require_once "./mvc/models/Food.php";
require_once "./mvc/models/Category.php";
require_once "./mvc/models/AdminAccount.php";

class Admin extends Controller
{
    function Index()
    {
        if (!isset($_SESSION['greenfood_admin']) || $_SESSION['greenfood_admin'] == null) {
            $this->view("login-admin", []);
        } else {
            $this->view("layoutAdmin", [
                'page' => 'index'
            ]);
        }
    }
    //login
    function Login()
    {
        $this->view("login-admin", []);
    }
    function Logout()
    {
        $_SESSION['greenfood_admin'] = null;
    }
    function VerifyAccount()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $admin_account = new AdminAccount();

        $isAdminAccountExist = $admin_account->isAdminAccountExist($username);
        if ($isAdminAccountExist) {
            $result = $admin_account->checkPassword($username, $password);
            if ($result['status_code'] == '200') {
                $_SESSION['greenfood_admin'] = $result['data'];
                echo json_encode(array(
                    'status' => 'Ok',
                    'status_code' => '200',
                    'message' => 'Login admin successful',
                    'data' => $result['data']
                ));
            } else {
                echo json_encode(array(
                    'status' => 'Fail',
                    'status_code' => '400',
                    'message' => 'Password incorrect',
                    'data' => ''
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 'Fail',
                'status_code' => '400',
                'message' => 'Admin\'s account not found',
                'data' => ''
            ));
        }
    }

    //food
    function Food()
    {
        $food = new Food();
        $cate = new Category();
        $dataFood = $food->getFoodList();
        // Call Views
        $this->view("layoutAdmin", [
            'page' => 'food',
            'listFood' => $dataFood,
            'listCategory' => $cate->getCategoryList()
        ]);
    }
    function GetFoodById()
    {
        $food = new Food();
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode(array(
                "status" => 'error',
                "status_code" => '404',
                "data" => [],
                "message" => 'Food not found'
            ));
        } else {
            $data = $food->getFoodById($id);
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200',
                "data" => $data,
                "message" => 'Get data successfully'
            ));
        }
    }
    function DeleteFoodById()
    {
        $food = new Food();
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode('Food not found');
        } else {
            $food->deleteFoodById($id);
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200'
            ));
        }
    }
    function AddNewFood()
    {
        $food = new Food();
        $foodName = $_POST['foodName'];
        $categoryId = $_POST['categoryId'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $foodImage = htmlspecialchars(basename($_FILES["image"]["name"]));

        $object = array(
            'foodName' => $foodName,
            'categoryId' => (int)$categoryId,
            'price' => (int)$price,
            'description' => $description,
            'image' => $foodImage
        );
        $rs = $food->createNewFood($object);
        if ($foodImage != '') {
            $image = $_FILES["image"];
            $this->UploadImage($image, "food");
        }
        if ($rs) {
            header('Location: ' . 'food/create_new_food_success');
        } else {
            header('Location: ' . 'food/create_new_food_failed');
        }
    }
    function UpdateFoodById()
    {
        $food = new Food();
        $foodId = $_POST['foodId'];
        $foodName = $_POST['foodName'];
        $categoryId = $_POST['categoryId'];
        $price = $_POST['price'];
        $description = $_POST['descriptionFood'];

        $imageBefore = $_POST['foodImage'];
        $foodImage = htmlspecialchars(basename($_FILES["image"]["name"]));

        $object = array(
            'foodId' => (int)$foodId,
            'foodName' => $foodName,
            'categoryId' => (int)$categoryId,
            'price' => (int)$price,
            'description' => $description,
            'image' => ($foodImage != '') ? $foodImage : $imageBefore
        );
        $rs = $food->updateFood($object);
        if ($foodImage != '') {
            $image = $_FILES["image"];
            $this->UploadImage($image, "food");
        }

        if ($rs) {
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200'
            ));
        }
    }
    function UploadImage($image, $folder = null)
    {
        $target_dir = "./public/assets/images/";
        //upload image
        if ($folder != null) {
            $target_dir .= $folder . "/";
        }

        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($image["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {

                // echo "The file " . htmlspecialchars(basename($_FILES["imageFood"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    // end food controller

    //Category
    function Category()
    {
        $cate = new Category();
        // Call Views
        $this->view("layoutAdmin", [
            'page' => 'category',
            'listCategory' => $cate->getCategoryList()
        ]);
    }
    function AddNewCategory()
    {
        $category = $this->model("Category");
        $categoryName = $_POST['categoryName'];
        $categoryImage = htmlspecialchars(basename($_FILES["image"]["name"]));
        $object = array(
            'categoryName' => $categoryName,
            'image' => $categoryImage
        );
        $rs = $category->createNewCategory($object);
        if ($categoryImage != '') {
            $image = $_FILES["image"];
            $this->UploadImage($image, "category");
        }

        if ($rs) {
            header('Location: ' . 'category');
        }
    }
    function DeleteCategoryById()
    {
        $category = $this->model("Category");

        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode('Category not found');
        } else {
            $category->deleteCategoryById($id);
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200'
            ));
        }
    }
    function GetCategoryById()
    {
        $category = $this->model("Category");
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode(array(
                "status" => 'error',
                "status_code" => '404',
                "data" => [],
                "message" => 'Category not found'
            ));
        } else {
            $data = $category->getCategoriesById($id);
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200',
                "data" => $data,
                "message" => 'Get category successfully'
            ));
        }
    }
    function UpdateCategoryById()
    {
        $category = $this->model("Category");
        $categoryId = $_POST['categoryId'];
        $categoryName = $_POST['categoryName'];
        $imageBefore = $_POST['categoryImage'];
        $categoryImage = htmlspecialchars(basename($_FILES["image"]["name"]));
        $object = array(
            'categoryId' => $categoryId,
            'categoryName' => $categoryName,
            'categoryImage' => ($categoryImage != '') ? $categoryImage : $imageBefore
        );
        $rs = $category->updateCategory($object);


        if ($categoryImage != '') {
            $image = $_FILES["image"];
            $this->UploadImage($image, "category");
        }

        if ($rs) {
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200',
                "data" => $object
            ));
        }
    }
    // end category controller

    //order
    function Order()
    {
        $order = $this->model("Bill");
        // Call Views
        $this->view("layoutAdmin", [
            'page' => 'order',
            'listOrder' => $order->getOrderList()
        ]);
    }
    function DeleteOrderById()
    {
        $order = $this->model("Bill");

        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode('Order not found');
        } else {
            $order->deleteOrderById($id);
            echo json_encode(array(
                "status" => 'success',
                "status_code" => '200'
            ));
        }
    }
    function ChangeStatusOrder()
    {
        $order = $this->model("Bill");
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        if ($id == -1) {
            echo json_encode(array(
                "status" => 'Ok',
                "status_code" => '200',
                "message" => 'Order not found'
            ));
        } else {
            $result = $order->changeStatusOrderById($id);
            if ($result['status_code'] == 200) {
                echo json_encode(array(
                    "status" => 'Ok',
                    "status_code" => '200',
                    "message" => 'Order\'s status has been changed',
                    "data" => $result['statusOrder']
                ));
            } else {
                echo json_encode(array(
                    "status" => $result['status'],
                    "status_code" => $result['status_code'],
                    "message" => $result['message']
                ));
            }
        }
    }
    function GetEarningMonthly()
    {
        $order = $this->model("Bill");
        echo json_encode($order->totalEarningMonthly(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
