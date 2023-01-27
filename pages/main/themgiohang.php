<?php
    session_start();
    include('../../admincp/config/config.php');
    //Thêm số lượng
    if (isset($_GET['cong'])){
        $id=$_GET['cong'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                $_SESSION['cart'] = $product;
            }else{
                $tangsoluong = $cart_item['soluong'] + 1;
                if($cart_item['soluong']<=9){
                    
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }else{
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }
                $_SESSION['cart'] = $product;
            }
        }
        header('location:../../index.php?quanly=giohang');
    }
    //Trừ số lượng trong giỏ hàng
    if (isset($_GET['tru'])){
        $id=$_GET['tru'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                $_SESSION['cart'] = $product;
            }else{
                $tangsoluong = $cart_item['soluong'] - 1;
                if($cart_item['soluong']>1){
                    
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }else{
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }
                $_SESSION['cart'] = $product;
            }
        }
        header('location:../../index.php?quanly=giohang');
    }
    //Xóa sản phẩm
    if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
            }
        $_SESSION['cart'] = $product;
        header('location:../../index.php?quanly=giohang');
        }
    }
    //Xóa tất cả sản phẩm
    if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
        unset($_SESSION['cart']);
        header('location:../../index.php?quanly=giohang');
    }
    //Thêm sản phẩm vào giỏ hàng

    if(isset($_POST['themgiohang'])){
    //session_destroy(); Xóa mảng
        $id=$_GET['idsanpham'];
        $soluong=1;
        $sql="SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
        $query = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($query);
        if($row){
            $new_product=array(array('tensanpham'=>$row['tensanpham'],'id'=>$id,'soluong'=>$soluong,'giasp'=>$row['giasp'],'hinhanh'=>$row['hinhanh'],'masp'=>$row['masp']));
        //Kiểm tra session giỏ hàng đã tồn tại chưa
        if(isset($_SESSION['cart'])){
            $found = false;
            foreach($_SESSION['cart'] as $cart_item){
                //Nếu dữ liệu trùng
                if($cart_item['id']==$id){
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$soluong+1,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                    $found = true;
                //Nếu dữ liệu không trùng
                }else{
                    $product []=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                    
                }
            }
            if($found == false){
                //Liên kết dữ liệu new_product với product
                $_SESSION['cart']=array_merge($product,$new_product);
            }else{
                $_SESSION['cart']=$product;
            }
        }else{
            $_SESSION['cart'] = $new_product;
        }
        } 
        header('location:../../index.php?quanly=giohang');
        //print_r($_SESSION['cart']);
    }
?>