
<?php  
    include('server/connection.php');
    //ambil data
    $id_produk = $_GET['id_produk'];
    $sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM gudang";
    $stmt_gudang = $conn->prepare($sql);
    $stmt_gudang->execute();
    $gudangs = $stmt_gudang->get_result();
?>
<?php

  if(isset($_POST['update'])){
    $id_produk = $_POST['id_produk'];
    
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $gudang = $_POST['gudang'];

    $sql = "UPDATE produk SET nama_produk = '$nama_produk', jenis_produk='$jenis_produk', jumlah_produk=$jumlah_produk,id_gudang = $gudang WHERE id_produk=$id_produk";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('Location:dashboard.php');
    } else {
        die("gagal");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
    <link
    rel="stylesheet"
    type="text/css"
    href="css/bootstrap.css"
  />
    <link rel="stylesheet" href="Input.css" />
  </head>
  <body>
    <nav class="navbar navbar-light" style="background-color:  #B7E0FF">
      <div class="container-fluid">
        <a class="navbar-brand me-5"
          ><img src="image/turu.jpg" alt="" width="120" 
        /></a>
        <form class="d-flex">
        <a href="edit_produk.php?logout=1" name="logout" class="btn me-4" style="background-color: #C96060;">Logout</a>
        </form>
      </div>
    </nav>
    <div class="wrapper">
      <input type="checkbox" id="btn" hidden>
      <nav id="sidebar">
         <div class="title">
             Menu
         </div>
         <ul class="list-items" >
            <li ><a href="dashboard.php"><i class="fas fa-th-large" style="color: #699BF7;"></i>Dashboard</a></li>
            <li><a href="menu_create.php.php"><i class="fas fa-plus-square" style="color: #699BF7;"></i>Tambah Baru</a></li>
            <li><a href="account.php"><i class=" fas fa-sliders-h" style="color: #699BF7;"></i>Settings</a></li>
           
         </ul>
      </nav>
   </div>
    <div class="header mt-5 ms-5">
      <h3>Input Produk Baru</h3>
    </div>
    <form action="edit_produk.php" method="post">
      <div class="d-flex justify-content-center">
        <div class="form-outline w-50 ">
            <input type="hidden" name="id_produk" value="<?php echo $data['id_produk'];?>"/>
          <label for="exampleInputEmail1" class="form-label ">Nama Produk</label>
          <input 
            type="text"
            class="form-control "
            id="nama_produk"
            name="nama_produk"
            aria-describedby="emailHelp"
            value="<?php echo $data['nama_produk'];?>"
          />
          </div>
        </div>
      </div>
        <div class="d-flex justify-content-center mt-3">
          <div class="form-outline w-50">
            <label for="exampleInputPassword1" class="form-label">Jenis Produk</label>
            <input
              type="text"
              class="form-control"
              id="jenis_produk"
              name="jenis_produk"
              value="<?php echo $data['jenis_produk'];?>"
            />
          </div>
        </div>
       <div class="d-flex justify-content-center mt-3">
        <div class="form-outline w-50">
          <label for="exampleInputPassword1" class="form-label">Jumlah Produk</label>
          <input
            type="number" id="jumlah_produk" name="jumlah_produk" min="1" max="99"
            class="form-control" value="<?php echo $data ['jumlah_produk'];?>"
          />
        </div>
       </div>
       <div class="d-flex justify-content-center">
        <select class="form-select mt-4 form-outline w-50" aria-label="Default select example" name="gudang">
          <<option selected>Plilih Gudang</option>
          <?php while($row = $gudangs->fetch_assoc()){?>
          <option value="<?php echo $row['id_gudang'];?>"><?php echo $row['nama_gudang'];?></option>
          <?php } ?>
         </select>
       </div>
      
       <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-3 form-outline w-25" name="update">Simpan</button>
       </div>
     
      
    </form>
  </body>
</html>
