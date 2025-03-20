<!-- 
<?php
session_start();
include('config/dbcon.php');
include('../function/myfunctions.php');


//     $name = $_POST['name'];

//     // Trước tiên, kiểm tra xem $name có rỗng không
//     if (empty($name)) {
//         redirect("add-category.php", "Tên danh mục không được bỏ trống");
//     } else {
//         // Sau đó, kiểm tra xem tên đã tồn tại trong bảng category chưa
//         $check_query = "SELECT * FROM category WHERE name = '$name'";
//         $check_result = mysqli_query($con, $check_query);

//         if (mysqli_num_rows($check_result) > 0) {
//             // Tên đã tồn tại, xuất thông báo lỗi
//             redirect("add-category.php", "Danh mục đã tồn tại");
//         } else {
//             // Tên chưa tồn tại, thêm vào cơ sở dữ liệu
//             $cate_query = "INSERT INTO category (name) VALUES ('$name')";
//             $cate_query_run = mysqli_query($con, $cate_query);

//             if ($cate_query_run) {
//                 redirect("add-category.php", "Lưu danh mục thành công");
//             } else {
//                 redirect("add-category.php", "Lưu danh mục không thành công");
//             }
//         }
//     }
// }
if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];

    $path = "../uploads"; // Thư mục lưu trữ hình ảnh
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Trước tiên, kiểm tra xem tên danh mục đã tồn tại trong cơ sở dữ liệu chưa
    $check_query = "SELECT * FROM category WHERE name = '$name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Tên danh mục đã tồn tại, xuất thông báo lỗi
        redirect("add-category.php", "Danh mục đã tồn tại");
    } else {
        // Tên danh mục chưa tồn tại, thêm vào cơ sở dữ liệu
        $category_query = "INSERT INTO category (name, image) VALUES ('$name', '$filename')";
        $category_query_run = mysqli_query($con, $category_query);

        if ($category_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            redirect("add-category.php", "Thêm danh mục thành công!");
        } else {
            redirect("add-category.php", "Thêm danh mục thất bại!");
        }
    }
}


// sửa danh mục
// else if (isset($_POST['edit_category_btn'])) {
//     $name = $_POST['name'];
//     $category_id = $_POST['category_id'];


//     //kiem tra ten danh mục

//     $check_query = "select * from category where name = '$name'";
//     $check_result = mysqli_query($con, $check_query);

//     if (mysqli_num_rows($check_result) > 0) {
//         redirect("edit-category.php?id=$category_id", "Tên danh mục đã tồn tại");
//     } else {
//         $update_query = "update category set name = '$name' where id = '$category_id' ";
//         $update_query_run = mysqli_query($con, $update_query);
//         if ($update_query_run) {
//             redirect("category.php", "Cập nhật danh mục thành công!");

//         } else {
//             redirect("edit-category.php?id=$category_id", "Cập nhật danh mục thất bại");
//         }

//     }







// }
else if (isset($_POST['edit_category_btn'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $old_image = $_POST['old_image'];

    // Kiểm tra xem tên danh mục có bị trùng không
    $check_query = "SELECT * FROM category WHERE name = '$name' AND id != '$category_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Tên danh mục đã tồn tại, xuất thông báo lỗi
        redirect("edit-category.php?id=$category_id", "Tên danh mục đã tồn tại");
    } else {
        $update_filename = ''; // Biến để lưu tên tệp ảnh mới

        // Kiểm tra xem có tải lên ảnh mới không
        if ($_FILES['image']['name'] != "") {
            $image_ext = pathinfo($image, PATHINFO_EXTENSION);
            $update_filename = time() . '.' . $image_ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        } else {
            // Nếu không có ảnh mới, sử dụng ảnh cũ
            $update_filename = $old_image;
        }

        $update_category_query = "UPDATE category SET name = '$name', image = '$update_filename' WHERE id = '$category_id'";
        $update_category_query_run = mysqli_query($con, $update_category_query);

        if ($update_category_query_run) {
            redirect("category.php", "Cập nhật danh mục thành công!");
        } else {
            redirect("edit-category.php?id=$category_id", "Cập nhật danh mục thất bại");
        }
    }
}

//end sửa danh mục
//xóa danh mục
// else if (isset($_POST['delete_category'])) {

//     $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

//     $delete_query = "delete from category where id = '$category_id'";
//     $delete_query_run = mysqli_query($con, $delete_query);

//     if ($delete_query_run) {
//         redirect("category.php", "Xóa danh mục thành công");
//     } else {
//         redirect("category.php", "Xóa danh mục thất bại");
//     }
// }
else if (isset($_POST['delete_category'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    // Lấy tên tệp ảnh từ cơ sở dữ liệu
    $image_query = "SELECT image FROM category WHERE id = '$category_id'";
    $image_result = mysqli_query($con, $image_query);
    $image_data = mysqli_fetch_assoc($image_result);
    $image_to_delete = $image_data['image'];

    // Xóa danh mục và ảnh cùng nhau
    $delete_query = "DELETE FROM category WHERE id = '$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        // Xóa ảnh từ thư mục uploads
        if (file_exists("../uploads/" . $image_to_delete)) {
            unlink("../uploads/" . $image_to_delete);
        }
        redirect("category.php", "Xóa danh mục thành công");
    } else {
        redirect("category.php", "Xóa danh mục  thất bại");
    }
}

//end xóa danh mục



// ---------------------------------------------------------------------------------

// Thêm thương hiệu
if (isset($_POST['add_brand_btn'])) {
    $name = $_POST['name'];

    // Trước tiên, kiểm tra xem $name có rỗng không
    if (empty($name)) {
        redirect("add-brand.php", "Tên phân loại không được bỏ trống");
    } else {
        // Sau đó, kiểm tra xem tên đã tồn tại trong bảng brand chưa
        $check_query = "SELECT * FROM brand WHERE name = '$name'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Tên đã tồn tại, xuất thông báo lỗi
            redirect("add-brand.php", "phân loại đã tồn tại");
        } else {
            // Tên chưa tồn tại, thêm vào cơ sở dữ liệu
            $brand_query = "INSERT INTO brand (name) VALUES ('$name')";
            $brand_query_run = mysqli_query($con, $brand_query);

            if ($brand_query_run) {
                redirect("add-brand.php", "Lưu phân loại thành công");
            } else {
                redirect("add-brand.php", "Lưu phân loại không thành công");
            }
        }
    }
}

// sửa thương hiệu
else if (isset($_POST['edit_brand_btn'])) {
    $name = $_POST['name'];
    $brand_id = $_POST['brand_id'];


    //kiem tra ten thương hiệu

    $check_query = "select * from brand where name = '$name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        redirect("edit-brand.php?id=$brand_id", "Tên phân loại đã tồn tại");
    } else {
        $update_query = "update brand set name = '$name' where id = '$brand_id' ";
        $update_query_run = mysqli_query($con, $update_query);
        if ($update_query_run) {
            redirect("brand.php", "Cập nhật phân loại thành công!");

        } else {
            redirect("edit-brand.php?id=$brand_id", "Cập nhật phân loại thất bại");
        }

    }

}
//end sửa thuong hiệu
//xóa thương hiệu
else if (isset($_POST['delete_brand'])) {

    $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);

    $delete_query = "delete from brand where id = '$brand_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        redirect("brand.php", "Xóa phân loại thành công");
    } else {
        redirect("brand.php", "Xóa phân loại thất bại");
    }
}
//end xóa thương hiệu

// thêm sản phẩm
else if (isset($_POST['add_product_btn'])) {
    $name = $_POST['name'];
    $catid = $_POST['catid'];
    $brandid = $_POST['brandid'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $trending = isset($_POST['trending']) ? '1' : '0';
    $image = $_FILES['image']['name'];

    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Trước tiên, kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu chưa
    $check_query = "SELECT * FROM product WHERE productName = '$name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Tên sản phẩm đã tồn tại, xuất thông báo lỗi
        redirect("add-product.php", "Tên sản phẩm đã tồn tại");
    } else {
        // Tên sản phẩm chưa tồn tại, thêm vào cơ sở dữ liệu
        $product_query = "INSERT INTO product (productName, catid, brandid, product_desc, image, quantity, trending, price) VALUES ('$name', '$catid', '$brandid', '$desc', '$filename', '$quantity', '$trending', '$price')";
        $product_query_run = mysqli_query($con, $product_query);

        if ($product_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            redirect("add-product.php", "Thêm sản phẩm thành công!");
        } else {
            redirect("add-product.php", "Thêm sản phẩm thất bại!");
        }
    }
}

//end thêm sản phẩm 


//xóa sản phẩm
else if (isset($_POST['delete_product_btn'])) {

    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM product WHERE id='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];


    $delete_query = "delete from product where id = '$product_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        // redirect("product.php", "Xóa sản phẩm thành công");
        echo 200;
    } else {
        // redirect("product.php", "Xóa sản phẩm thất bại");
        echo 500;
    }
}
//end xóa sản phẩm

// cập nhậy sản phẩm
else if (isset($_POST['edit_product_btn'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $catid = $_POST['catid'];
    $brandid = $_POST['brandid'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $trending = isset($_POST['trending']) ? '1' : '0';




    $path = "../uploads";

    // chuyển đổ ảnh cũ thành ảnh mới
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }


    $update_product_query = "UPDATE product SET productName = '$name', catid = '$catid',brandid = '$brandid',product_desc = '$desc', image = '$update_filename',quantity = '$quantity', trending ='$trending', price = '$price' WhERE id = '$product_id' ";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "Cập nhật sản phẩm thành công");
    } else {
        redirect("edit-product.php?id=$product_id", "Cập nhật sản phẩm thất bại");
    }

}
//Cập nhật trạng thái đơn hàng
else if (isset($_POST['update_order_btn'])) {
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status = '$order_status' WHERE tracking_no = '$track_no'";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    redirect("view-orders.php?t=$track_no", "Cập nhật đơn hàng thành công!");

} else {
    header('Location: ../index.php');
}



?>