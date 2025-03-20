<?php

session_start();

// if (isset($_SESSION['auth'])) {
//     $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
//     header('Location: index.php');
//     exit();
// }

include('includes/header.php');
?>
<main role="main" class="mb-2">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="image-overlay">
                    <img src="https://nhaxinh.com/wp-content/uploads/2021/11/nha-xinh-gioi-thieu-chat-luong-251121.jpg"
                        alt="Background Image">
                    <div class="overlay-text">
                        <h1>Welcome to SHOP BÁN GIÀY DÉP</h1>
                        <p>Chào bạn đã đến với chúng tôi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Block content -->
    <div class="container mt-2">
        <h1 class="text-center">Giá trị và sự khác biệt</h1>
        <hr>
        <div class="row">
            <div class="col col-md-12">
                <h5 class="text-center">Từ ý tưởng tạo nên sự khác biệt, SHOP GIÀY DÉP đã không ngừng phát triển  
                 và vươn lên trở thành một trong những thương hiệu hàng đầu trong lĩnh vực giày dép tại Việt Nam.  
                Đến nay, SHOP GIÀY DÉP đã có nhiều cửa hàng quy mô và chuyên nghiệp tại các thành phố lớn như Hà Nội, TP.HCM ...</h5>
                <p class="text-center">Với mong muốn mang đến cho khách hàng những sản phẩm chất lượng cao, SHOP GIÀY DÉP luôn chú trọng vào  
                thiết kế và sản xuất giày dép theo xu hướng thời trang mới nhất. Danh mục sản phẩm của SHOP GIÀY DÉP được cập nhật liên tục,  
                cung cấp các mẫu giày phù hợp với nhiều phong cách khác nhau. Được thiết kế và sản xuất bởi đội ngũ chuyên nghiệp,  
                sản phẩm của SHOP GIÀY DÉP không chỉ mang lại sự thoải mái mà còn giúp khách hàng tự tin khẳng định phong cách riêng.</p>
                <div class="text-center">
                    <a href="index.php" class="btn btn-primary btn-lg">Ghé thăm Shop Giày Dép <i class="fa fa-forward"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-md-12">
                <h1 class="tieu-de">Chúng tôi ở đây!</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-md-12">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0647590273684!2d105.7715714111263!3d21.030094680538852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b110f8e7d3%3A0x19d9fd37fcd69933!2zMzQgxJAuIE3hu7kgxJDDrG5oLCBN4bu5IMSQw6xuaCwgTmFtIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1742196474897!5m2!1svi!2s" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            </div>
        </div>
    </div>
    <!-- End block content -->
</main>
<?php include('includes/footer.php'); ?>