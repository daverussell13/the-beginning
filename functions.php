<?php
session_start();
// database connection (mysqli)
$conn = mysqli_connect();

function query($command){
    global $conn;
    $result = mysqli_query($conn,$command);
    if(!$result){
        echo mysqli_error($conn);
        die();
    }
    $arrData = [];
    while( $data = mysqli_fetch_assoc($result) ){
        $arrData[] = $data;
    }
    return $arrData;
}

function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = upload();
    if(!$gambar){
        return false;
    }
    $query = "INSERT INTO mahasiswa VALUES (
        0,'$nama','$nrp','$email','$jurusan','$gambar'
        )";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus($id,$gambar){
    global $conn;
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id");
    unlink("img/$gambar");
    return mysqli_affected_rows($conn);
}

function edit($data,$id){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    if($_FILES["gambar"]["error"] === 4){
        $gambar = htmlspecialchars($data["gambarLama"]);
    }
    else if($_FILES["gambar"]["error"] === 0){
        $gambar = upload();
    }
    $query = "UPDATE mahasiswa SET
            nama='$nama', nrp='$nrp', email='$email', jurusan='$jurusan', gambar='$gambar'
            WHERE id=$id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function cari($keyword,$category){
    if($category)
    $command = "SELECT * FROM mahasiswa WHERE $category LIKE '%$keyword%'";
    return query($command);
}

function upload(){
    $fileName = $_FILES["gambar"]["name"];
    $tmpName = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];
    $fileSize = $_FILES["gambar"]["size"];
    $validExt = ["jpg","jpeg","png"];
    $extension = pathinfo($fileName,PATHINFO_EXTENSION);

    if($error == 4){
        echo "<script>
            alert('Upload gambar terlebih dahulu!!')
            </script>";
        return false;
    }
    else if(!in_array(strtolower($extension),$validExt)){
        echo "<script>
            alert('Format file tidak didukung!!')
            </script>";
        return false;
    }
    else if($fileSize > 2000000){
        echo "<script>
            alert('Ukuran files terlalu besar!!')
            </script>";
        return false;
    }
    else {
        $namaFileBaru = uniqid();
        $namaFileBaru = $namaFileBaru.".".$extension;
        move_uploaded_file($tmpName,"img/$namaFileBaru");
        return $namaFileBaru;
    }
}

function registrasi($data){
    global $conn;
    if(strlen($data["userreg"]) > 18){
        echo "<script>
                alert('Username terlalu panjang maximal 18 character')
              </script>";
        return false;
    }
    $username = str_replace(" ","",strtolower(stripslashes($data["userreg"])));
    $userNameCheck = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
    if(mysqli_fetch_assoc($userNameCheck)){
        echo "<script>
                alert('Username sudah dipakai')
              </script>";
        return false;
    }
    $password = mysqli_real_escape_string($conn,$data["passreg"]);
    $confpass = mysqli_real_escape_string($conn,$data["confpassreg"]);
    if($password != $confpass){
        echo "<script>
                alert('Konfirmasi password tidak sesuai')
              </script>";
        return false;
    }
    $name = htmlspecialchars($data["name"]);
    if(strtolower($name) != "alexander errent" && strtolower($name) != "geraldo kenzhi"){
        echo "<script>
                alert('Gunakan 2 nama depan saja dan jangan berbohong jancok')
             </script>";
        return false;
    }
    $password = password_hash($password,PASSWORD_DEFAULT);
    mysqli_query($conn,"INSERT INTO users VALUES ( 0, '$username', '$password', '$name')");
    return mysqli_affected_rows($conn);
}

function login($data){
    global $conn;
    $username = htmlspecialchars($data["userlog"]);
    $password = htmlspecialchars($data["passlog"]);
    $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row["password"])){
            //  set cookie
            if(isset($_POST["remember"])){
                // ini akan berisi id
                setcookie('XUSER_C',$row["id"],time()+86400);
                // ini akan berisi hash username dari username yang login
                setcookie('N_USER_',hash('sha256',$row["username"]),time()+86400);
            }
            // set sessionnya
            $_SESSION["login"] = true;
            $_SESSION["name"] = $row["name"];
            return true;
        }
    }
    return false;
}

?>