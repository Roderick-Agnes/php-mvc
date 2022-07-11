<?php
//require models
require_once "./mvc/models/Food.php";
require_once "./mvc/models/Category.php";

class Admin extends Controller
{
    function Index()
    {
        $this->view("layoutAdmin", [
            'page' => 'index'
        ]);
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
}
