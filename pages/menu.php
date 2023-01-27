<?php
    $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
    $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
?>
<div class="menu">
    <ul class="list_menu">
                <li><a href="index.php">Trang chủ</a></li>
        <li> <a href="">Danh mục sản phẩm</a>
            <ul class="submenu">
                <?php
                while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                ?>
                <li><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
                <?php
                }
                ?>
            </ul>
        </li>
                <li><a href="index.php?quanly=giohang">Giỏ hàng</a></li>
                <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
                <li><a href="index.php?quanly=lienhe">Liên hệ</a></li>
                <li><a href="">Các chương trình ưu đãi</a>
                    <ul class="submenu">
                        <li><a href="">Giới thiệu shop!</a></li>
                        <li><a href="">Các mã voucher hot!</a></li>
                        <li><a href="">Ưu đãi ngày 20/11!</a></li>
                    </ul>
                </li>
            </ul>
            <p class="">
                <form class="search" action="index.php?quanly=timkiem" method="GET">
                <input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
                <input type="submit" name="timkiem" value="Tìm kiếm">
                </form>
            </p>
        </div>