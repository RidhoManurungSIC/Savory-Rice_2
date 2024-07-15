<?php 
// koneksi
    $conn = mysqli_connect("localhost", "root", "", "test_db");

// tampilkan data dengan memanggin namanya
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// registrasi
function registrasi($data){
    global $conn;
    // tangkap data
    $username = strtolower(stripcslashes($data["username"]));
    $email = strtolower(stripcslashes($data["email"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $id_akses = "4";
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    // cek username sudah ada atau belum
    $result = mysqli_query($conn,"SELECT username FROM users WHERE  username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('username sudah digunakan!');
            // document.location.href = 'registrasi.php';
        </script>
    ";
    return false;
    }

    // cek email
    $result = mysqli_query($conn,"SELECT email FROM users WHERE  email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('email sudah digunakan!');
            // document.location.href = './index.php';
        </script>
    ";
    return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru kedatabase
    mysqli_query($conn, "INSERT INTO users 
        VALUES('','$username','$email','$password','$id_akses',$create_at,$update_at)");

    return mysqli_affected_rows($conn);
}
function registrasi_akses($data){
    global $conn;
    // tangkap data
    $username = strtolower(stripcslashes($data["username"]));
    $email = strtolower(stripcslashes($data["email"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $id_akses = $data["id_akses"];
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    // cek username sudah ada atau belum
    $result = mysqli_query($conn,"SELECT username FROM users WHERE  username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('username sudah digunakan!');
            // document.location.href = 'registrasi.php';
        </script>
    ";
    return false;
    }

    // cek email
    $result = mysqli_query($conn,"SELECT email FROM users WHERE  email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('email sudah digunakan!');
            // document.location.href = './index.php';
        </script>
    ";
    return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru kedatabase
    mysqli_query($conn, "INSERT INTO users 
        VALUES('','$username','$email','$password','$id_akses',$create_at,$update_at)");

    return mysqli_affected_rows($conn);
}

// tambah menu
function addmenu($data){
    global $conn;
    // tangkap data
    $nama_masakan = ucwords(stripcslashes($data["nama_masakan"]));
    $kategori_masakan = $data["kategori_masakan"];
    $tipe_masakan = $data["tipe_masakan"];
    $harga =  strtolower(stripcslashes($data["harga"]));

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // $status_masakan =  strtolower(stripcslashes($data["status_masakan"]));
    $status_masakan =  "";
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    // tambahkan menu baru ke database
    mysqli_query($conn, "INSERT INTO menus 
        VALUES('','$nama_masakan','$kategori_masakan','$tipe_masakan','$harga','$status_masakan','$gambar',$create_at,$update_at)");

    return mysqli_affected_rows($conn);
}

// tambah menu
function addmenuk($data){
    global $conn;
    // tangkap data
    $nama_masakan = ucwords(stripcslashes($data["nama_masakan"]));
    $kategori_masakan = $data["kategori_masakan"];
    $tipe_masakan = $data["tipe_masakan"];
    $harga =  strtolower(stripcslashes($data["harga"]));

    $gambar = uploadK();
    if (!$gambar) {
        return false;
    }

    // $status_masakan =  strtolower(stripcslashes($data["status_masakan"]));
    $status_masakan =  "";
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    // tambahkan menu baru ke database
    mysqli_query($conn, "INSERT INTO menus 
        VALUES('','$nama_masakan','$kategori_masakan','$tipe_masakan','$harga','$status_masakan','$gambar',$create_at,$update_at)");

    return mysqli_affected_rows($conn);
}

// tambah box pesan
function addbox($data){
    global $conn;
    $user = ucwords(stripcslashes($_SESSION["user"]));
    $nama = ucwords(stripcslashes($data["nama"]));
    $email = strtolower(stripcslashes($data["email"]));
    $subjek = $data["subjek"];
    $rating =  $data["rating"];
    $pesan =  strtolower(stripcslashes($data["pesan"]));
    $status =  2;

    $file = "";

    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    

    mysqli_query($conn, "INSERT INTO pesan
        VALUES('','$user','$nama','$email','$subjek','$rating','$pesan', $status, '$file', $create_at, $update_at)");

    mysqli_query($conn, "INSERT INTO box_pesan
        VALUES('','$user','$nama','$email','$subjek','$rating','$pesan', $status, $create_at, $update_at)");

    return mysqli_affected_rows($conn);
}

// tambah box pesan paketan pesta
function addboxp($data){
    global $conn;
    $akun = ucwords(stripcslashes($_SESSION["user"]));
    $nama = ucwords(stripcslashes($data["nama"]));
    $email = strtolower(stripcslashes($data["email"]));
    $nohp = $data["nohp"];
    $tanggal =  $data["tanggal"];
    $jam =  $data["jam"];
    $orang =  $data["orang"];
    $keterangan =  strtolower(stripcslashes($data["keterangan"]));
    $status =  4;
    $bayar =  1;
    $jpaketan =  1;
    $file = "";
    $id_p = "SRP".uniqid();
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    

    mysqli_query($conn, "INSERT INTO box_paketan
        VALUES('', '$id_p', '$akun','$nama','$email','$nohp','$tanggal','$jam', '$orang' , 
        '$keterangan', $status, $bayar, $jpaketan , '$file', $create_at, $update_at)");


    return mysqli_affected_rows($conn);
}

// tambah box pesan menu
function addboxm($data){
    global $conn;
    $id_m = $data["id_masakan"];
    $id_pm = "TPM".uniqid();
    $username = ucwords(stripcslashes($_SESSION["user"]));
    $email = 1 ;
    $menu = ucwords(stripcslashes($data["menu"]));
    $jenis_menu =  $data["jmenu"]; 
    $harga =  $data["harga"];
    $jumlah =  $data["jumlah"];
    $m_pesanan =  $data["metode_pesanan"];
    $status_pesanan =  4;
    $m_pembayaran = $data["jbayar"];
    $keterangan = $data["keterangan"];
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";
    $file = 1;

    mysqli_query($conn, "INSERT INTO box_pmenu
        VALUES('', $id_m,'$id_pm','$username','$email','$menu', $jenis_menu, $harga, $jumlah, 
        $m_pesanan, $status_pesanan, $m_pembayaran,'$keterangan','$file', $create_at, $update_at)");


    return mysqli_affected_rows($conn);
}

// tambaha  pesan
function addpesan($data){
    global $conn;
    $id = $data["id"];
    $user = ucwords(stripcslashes($_SESSION["user"]));
    $nama = ucwords(stripcslashes($data["nama"]));
    $email = strtolower(stripcslashes($data["email"]));
    $subjek = $data["subjek"];
    $rating =  $data["rating"];
    $pesan =  strtolower(stripcslashes($data["pesan"]));
    $status =  3;
    $file = "";
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    mysqli_query($conn, "INSERT INTO pesan
        VALUES('','$user','$nama','$email','$subjek','$rating','$pesan', $status, '$file',  $create_at, $update_at)");

    return mysqli_affected_rows($conn);
}


    // cari data
    function cari_user($keyword){
        $query = "SELECT users.id,users.username,users.email,users.password,users.id_akses,akses.tipe_akses 
        FROM users INNER JOIN akses ON users.id_akses = akses.id_akses
            WHERE
        users.username LIKE '%$keyword%' OR 
        users.email LIKE '%$keyword%' OR 
        users.id_akses LIKE '%$keyword%' 
        ";
    return query($query);
    }

    function cari_pesan($keyword){
        $query = "SELECT pesan.id,pesan.pengguna,pesan.nama,pesan.email,pesan.subjek,
  subjek.keterangan,pesan.rating,pesan.pesan, pesan.detile_pesan,status_pesan.status
  FROM pesan INNER JOIN subjek ON pesan.subjek = subjek.id
  INNER JOIN status_pesan ON pesan.detile_pesan = status_pesan.id
            WHERE
        pesan.pengguna LIKE '%$keyword%' OR 
        pesan.nama LIKE '%$keyword%' OR 
        pesan.email LIKE '%$keyword%' OR
        pesan.subjek LIKE '%$keyword%' OR 
        pesan.rating LIKE '%$keyword%' OR 
        pesan.pesan LIKE '%$keyword%' OR
        pesan.detile_pesan LIKE '%$keyword%' OR 
        status_pesan.status LIKE '%$keyword%' 
        ";
    return query($query);
    }

    function cari_menu($keyword){
        $query = "SELECT menus.id_masakan,menus.nama_masakan,menus.kategori_masakan,
        menus.tipe_masakan,menus.harga,menus.gambar,tipe_masakan.jenis_masakan
        FROM menus INNER JOIN tipe_masakan ON menus.tipe_masakan = tipe_masakan.id
            WHERE
        menus.nama_masakan LIKE '%$keyword%' OR 
        menus.kategori_masakan LIKE '%$keyword%' OR 
        menus.tipe_masakan LIKE '%$keyword%' OR
        menus.harga LIKE '%$keyword%' OR 
        menus.gambar LIKE '%$keyword%' OR 
        tipe_masakan.jenis_masakan LIKE '%$keyword%' 
        ";
    return query($query);
    }

    function cari_paket_pesta($keyword){
        $query = "SELECT paketan.id,paketan.akun,paketan.nama,paketan.email,paketan.id_srp,
    paketan.nohp,paketan.tanggal,paketan.jam,paketan.orang,
    paketan.keterangan,paketan.status,status_paket.status_paket,paketan.bayar,
    pembayaran.tipe_pembayaran,paketan.jpaketan,model_paket.jpaket, model_paket.harga,paketan.file
    FROM paketan INNER JOIN status_paket ON paketan.status = status_paket.id
    INNER JOIN pembayaran ON paketan.bayar = pembayaran.id
    INNER JOIN model_paket ON paketan.jpaketan = model_paket.id
            WHERE
        paketan.akun LIKE '%$keyword%' OR 
        paketan.nama LIKE '%$keyword%' OR 
        paketan.id_srp LIKE '%$keyword%' OR 
        model_paket.jpaket LIKE '%$keyword%' OR
        paketan.tanggal LIKE '%$keyword%' OR 
        paketan.jam LIKE '%$keyword%' OR 
        paketan.orang LIKE '%$keyword%' OR 
        pembayaran.tipe_pembayaran LIKE '%$keyword%' OR 
        status_paket.status_paket LIKE '%$keyword%' 
        ";
    return query($query);
    }

    // hapus user
    function hapus_user($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus menu
    function hapus_menu($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM menus WHERE id_masakan = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus pesan
    function hapus_pesan($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM pesan WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus box
    function hapus_box($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM box_pesan WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus boxp
    function hapus_boxp($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM box_paketan WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus boxm
    function hapus_boxm($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM box_pmenu WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus transkasip3
    function hapus_tp3($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM paketan WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // hapus transkasipm
    function hapus_tpm($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM pesan_menu WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // upload gambar
    function upload(){
        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpname = $_FILES['gambar']['tmp_name'];

        if ($error === 4) {
            echo"<script>
                    alert('pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namafile);
        $extensiGambar =  strtolower(end($extensiGambar));

        if (!in_array($extensiGambar,$extensiGambarValid)) {
            echo"<script>
                    alert('yang anda upload bukan gambar!');
                </script>";
            return false;
        }

        if ($ukuranfile > 1000000) {
            echo"<script>
            alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.'; 
        $namafilebaru .= $extensiGambar; 

        move_uploaded_file($tmpname,'../assets/upload/' . $namafilebaru);

        return $namafilebaru;
    }

    // upload gambar client
    function uploadk(){
        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpname = $_FILES['gambar']['tmp_name'];

        if ($error === 4) {
            echo"<script>
                    alert('pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namafile);
        $extensiGambar =  strtolower(end($extensiGambar));

        if (!in_array($extensiGambar,$extensiGambarValid)) {
            echo"<script>
                    alert('yang anda upload bukan gambar!');
                </script>";
            return false;
        }

        if ($ukuranfile > 1000000) {
            echo"<script>
            alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.'; 
        $namafilebaru .= $extensiGambar; 

        move_uploaded_file($tmpname,'../../assets/upload/' . $namafilebaru);

        return $namafilebaru;
    }

    // upload gambar bukti pembayaran
    function upload_pembayaran(){
        $namafile = $_FILES['file']['name'];
        $ukuranfile = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tmpname = $_FILES['file']['tmp_name'];

        if ($error === 4) {
            echo"<script>
                    alert('pilih file terlebih dahulu!');
                </script>";
            return false;
        }

        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namafile);
        $extensiGambar =  strtolower(end($extensiGambar));

        if (!in_array($extensiGambar,$extensiGambarValid)) {
            echo"<script>
                    alert('yang anda upload bukan gambar ');
                </script>";
            return false;
        }

        if ($ukuranfile > 1000000) {
            echo"<script>
            alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.'; 
        $namafilebaru .= $extensiGambar; 
        
        move_uploaded_file($tmpname,'../assets/bukti_pembayaran/'. $namafilebaru);
        return $namafilebaru;
    }

    // upload gambar bukti pembayaran client
    function upload_pembayarank(){
        $namafile = $_FILES['file']['name'];
        $ukuranfile = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tmpname = $_FILES['file']['tmp_name'];

        if ($error === 4) {
            echo"<script>
                    alert('pilih file terlebih dahulu!');
                </script>";
            return false;
        }

        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namafile);
        $extensiGambar =  strtolower(end($extensiGambar));

        if (!in_array($extensiGambar,$extensiGambarValid)) {
            echo"<script>
                    alert('yang anda upload bukan gambar ');
                </script>";
            return false;
        }

        if ($ukuranfile > 1000000) {
            echo"<script>
            alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.'; 
        $namafilebaru .= $extensiGambar; 
        
        move_uploaded_file($tmpname,'../../assets/bukti_pembayaran/'. $namafilebaru);
        return $namafilebaru;
    }

    // ubah user
    function ubah_user($data){
        global $conn;
        $id = $data["id"];
        $username = htmlspecialchars($data["username"]);
        $email = htmlspecialchars($data["email"]);
        $id_akses = htmlspecialchars($data["id_akses"]);
        
        $query= "UPDATE users
                    SET
                username = '$username',
                email = '$email',
                id_akses = '$id_akses'
                WHERE id = $id;
                ";
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

    // ubah aduan
    function ubah_adn($data){
        global $conn;
        $id = $data["id"];
        $nama = ucwords(stripcslashes($data["nama"]));
        $email =strtolower(stripcslashes($data["email"]));
        $subjek = $data["subjek"];
        $rating =  $data["rating"];
        $pesan = strtolower(stripcslashes($data["pesan"]));
        
        $query= "UPDATE pesan
                    SET
                 nama = '$nama',
                email = '$email',
                subjek = '$subjek',
                rating = '$rating',
                pesan = '$pesan'
                WHERE id = $id;
                ";
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah menu
    function ubah_menu($data){
        global $conn;
        $id_masakan = $data["id_masakan"];
        $nama_masakan = ucwords(stripcslashes($data["nama_masakan"]));
        $kategori_masakan = $data["kategori_masakan"];
        $tipe_masakan = $data["tipe_masakan"];
        $harga =  strtolower(stripcslashes($data["harga"]));
        $gambarlama = htmlspecialchars($data["gambarlama"]);
        // $status_masakan =  strtolower(stripcslashes($data["status_masakan"]));

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        }else {
            $gambar = upload();
        }
        
        $query= "UPDATE menus
                    SET
                nama_masakan = '$nama_masakan',
                kategori_masakan = '$kategori_masakan',
                tipe_masakan = '$tipe_masakan',
                harga = '$harga',
                gambar = '$gambar'
                WHERE id_masakan = $id_masakan;
                ";
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah menu client
    function ubah_menuk($data){
        global $conn;
        $id_masakan = $data["id_masakan"];
        $nama_masakan = ucwords(stripcslashes($data["nama_masakan"]));
        $kategori_masakan = $data["kategori_masakan"];
        $tipe_masakan = $data["tipe_masakan"];
        $harga =  strtolower(stripcslashes($data["harga"]));
        $gambarlama = htmlspecialchars($data["gambarlama"]);
        // $status_masakan =  strtolower(stripcslashes($data["status_masakan"]));

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        }else {
            $gambar = uploadk();
        }
        
        $query= "UPDATE menus
                    SET
                nama_masakan = '$nama_masakan',
                kategori_masakan = '$kategori_masakan',
                tipe_masakan = '$tipe_masakan',
                harga = '$harga',
                gambar = '$gambar'
                WHERE id_masakan = $id_masakan;
                ";
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah box all
    function ubah_box($data){
        global $conn;
        $id = $data["id"];
        $user = ucwords(stripcslashes($_SESSION["user"]));
        $nama = ucwords(stripcslashes($data["nama"]));
        $email =strtolower(stripcslashes($data["email"]));
        $subjek = $data["subjek"];
        $rating =  $data["rating"];
        $pesan = strtolower(stripcslashes($data["pesan"]));
        $status =  1 ;
        $file = "";
        $create_at="current_timestamp()";
        $update_at="current_timestamp()";
    
        mysqli_query($conn, "INSERT INTO pesan
        VALUES('','$user','$nama','$email','$subjek','$rating','$pesan', $status, '$file', $create_at, $update_at)");
        
        $query= "UPDATE box_pesan
                    SET
                nama = '$nama',
                email = '$email',
                subjek = '$subjek',
                rating = '$rating',
                pesan = '$pesan',
                status = $status
                WHERE id = $id ;
                ";
    
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah boxm
    function ubah_boxm($data){
        $id = $data["id"];
        global $conn;
        $id_m = $data["menu"];
        $nama= $data["nama"];
        $email = $data["email"] ;

        if ($data["menu"] == 1 ) {
            $isi_m = "Selada Khas Banjar";
        }elseif ($data["menu"] == 2) {
            $isi_m = "Otak Otak Khas Melayu";
        }elseif ($data["menu"] == 3) {
            $isi_m = "Salad Nusantara";
        }elseif ($data["menu"] == 4) {
            $isi_m = "Strawberry Salad Drink";
        }elseif ($data["menu"] == 5) {
            $isi_m = "Fruit Salad Jelly Drink";
        }elseif ($data["menu"] == 6) {
            $isi_m = "Fresh Fruit With Calamansi Juice";
        }elseif ($data["menu"] == 7) {
            $isi_m = "Bubur Ayam";
        }elseif ($data["menu"] == 8) {
            $isi_m = "Nasi Uduk";
        }elseif ($data["menu"] == 9) {
            $isi_m = "Soto";
        }elseif ($data["menu"] == 10) {
            $isi_m = "Lemon Water";
        }elseif ($data["menu"] == 11) {
            $isi_m = "Ginger Tea";
        }elseif ($data["menu"] == 12) {
            $isi_m = "Breakfast Blend Coffe";
        }elseif ($data["menu"] == 13) {
            $isi_m = "Beff Teriyaki";
        }elseif ($data["menu"] == 14) {
            $isi_m = "Salad Ayam";
        }elseif ($data["menu"] == 15) {
            $isi_m = "Tempura Udang";
        }elseif ($data["menu"] == 16) {
            $isi_m = "Cendol Ice";
        }elseif ($data["menu"] == 17) {
            $isi_m = "Milkshake Banana Split";
        }elseif ($data["menu"] == 18) {
            $isi_m = "Energy Smoothie";
        }elseif ($data["menu"] == 19) {
            $isi_m = "Spageti Carbonara";
        }elseif ($data["menu"] == 20) {
            $isi_m = "Baked Salmon";
        }elseif ($data["menu"] == 21) {
            $isi_m = "Pesto Chicken Baked";
        }elseif ($data["menu"] == 22) {
            $isi_m = "Iced Milk Coffe";
        }elseif ($data["menu"] == 23) {
            $isi_m = "Teh Tarik";
        }else {
            $isi_m = "Iced Dawet";
        }
        $menu = $isi_m;

        if ($data["menu"] == 1 || $data["menu"] == 2 || $data["menu"] == 3 
        || $data["menu"] == 4 || $data["menu"] == 5 || $data["menu"] == 6) {
            $isi_jm = 1;
        }elseif ($data["menu"] == 7 || $data["menu"] == 8 || $data["menu"] == 9 
        || $data["menu"] == 10 || $data["menu"] == 11 || $data["menu"] == 12) {
            $isi_jm = 2;
        }elseif ($data["menu"] == 13 || $data["menu"] == 14 || $data["menu"] == 15 
        || $data["menu"] == 16 || $data["menu"] == 17 || $data["menu"] == 18) {
            $isi_jm = 3;
        }else {
            $isi_jm = 4;
        }
        $jenis_menu =  $isi_jm; 

        if ($data["menu"] == 1 ) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 2) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 3) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 4) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 5) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 6) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 7) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 8) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 9) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 10) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 11) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 12) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 13) {
            $isi_h = "25000";
        }elseif ($data["menu"] == 14) {
            $isi_h = "20000";
        }elseif ($data["menu"] == 15) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 16) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 17) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 18) {
            $isi_h = "17000";
        }elseif ($data["menu"] == 19) {
            $isi_h = "20000";
        }elseif ($data["menu"] == 20) {
            $isi_h = "25000";
        }elseif ($data["menu"] == 21) {
            $isi_h = "30000";
        }elseif ($data["menu"] == 22) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 23) {
            $isi_h = "17000";
        }else {
            $isi_h = "12000";
        }
        $harga =  $isi_h;

        $jumlah =  $data["jumlah"];
        $m_pesanan =  $data["m_pesanan"];
        $status_pesanan =  4;
        $m_pembayaran =  $data["m_pembayaran"];
        $keterangan = $data["keterangan"];

        if ($m_pembayaran == 1) {
            $file = "tunai";
        }else {
            $file = upload_pembayaran();
            if (!$file) {
                return false; 
            }
        }
            
        $query= "UPDATE box_pmenu
                    SET
                id_m = '$id_m',
                nama = '$nama',
                email = '$email',
                menu = '$menu',
                jenis_menu = '$jenis_menu',
                harga = '$harga',
                jumlah = '$jumlah',
                m_pesanan = '$m_pesanan',
                status_pesanan = $status_pesanan,
                m_pembayaran = '$m_pembayaran',
                keterangan = '$keterangan',
                file = '$file'
                WHERE id = $id ;
                ";
    
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }
        
        // ubah boxm client
    function ubah_boxmK($data){
        $id = $data["id"];
        global $conn;
        $id_m = $data["menu"];
        $nama= $data["nama"];
        $email = $data["email"] ;

        if ($data["menu"] == 1 ) {
            $isi_m = "Selada Khas Banjar";
        }elseif ($data["menu"] == 2) {
            $isi_m = "Otak Otak Khas Melayu";
        }elseif ($data["menu"] == 3) {
            $isi_m = "Salad Nusantara";
        }elseif ($data["menu"] == 4) {
            $isi_m = "Strawberry Salad Drink";
        }elseif ($data["menu"] == 5) {
            $isi_m = "Fruit Salad Jelly Drink";
        }elseif ($data["menu"] == 6) {
            $isi_m = "Fresh Fruit With Calamansi Juice";
        }elseif ($data["menu"] == 7) {
            $isi_m = "Bubur Ayam";
        }elseif ($data["menu"] == 8) {
            $isi_m = "Nasi Uduk";
        }elseif ($data["menu"] == 9) {
            $isi_m = "Soto";
        }elseif ($data["menu"] == 10) {
            $isi_m = "Lemon Water";
        }elseif ($data["menu"] == 11) {
            $isi_m = "Ginger Tea";
        }elseif ($data["menu"] == 12) {
            $isi_m = "Breakfast Blend Coffe";
        }elseif ($data["menu"] == 13) {
            $isi_m = "Beff Teriyaki";
        }elseif ($data["menu"] == 14) {
            $isi_m = "Salad Ayam";
        }elseif ($data["menu"] == 15) {
            $isi_m = "Tempura Udang";
        }elseif ($data["menu"] == 16) {
            $isi_m = "Cendol Ice";
        }elseif ($data["menu"] == 17) {
            $isi_m = "Milkshake Banana Split";
        }elseif ($data["menu"] == 18) {
            $isi_m = "Energy Smoothie";
        }elseif ($data["menu"] == 19) {
            $isi_m = "Spageti Carbonara";
        }elseif ($data["menu"] == 20) {
            $isi_m = "Baked Salmon";
        }elseif ($data["menu"] == 21) {
            $isi_m = "Pesto Chicken Baked";
        }elseif ($data["menu"] == 22) {
            $isi_m = "Iced Milk Coffe";
        }elseif ($data["menu"] == 23) {
            $isi_m = "Teh Tarik";
        }else {
            $isi_m = "Iced Dawet";
        }
        $menu = $isi_m;

        if ($data["menu"] == 1 || $data["menu"] == 2 || $data["menu"] == 3 
        || $data["menu"] == 4 || $data["menu"] == 5 || $data["menu"] == 6) {
            $isi_jm = 1;
        }elseif ($data["menu"] == 7 || $data["menu"] == 8 || $data["menu"] == 9 
        || $data["menu"] == 10 || $data["menu"] == 11 || $data["menu"] == 12) {
            $isi_jm = 2;
        }elseif ($data["menu"] == 13 || $data["menu"] == 14 || $data["menu"] == 15 
        || $data["menu"] == 16 || $data["menu"] == 17 || $data["menu"] == 18) {
            $isi_jm = 3;
        }else {
            $isi_jm = 4;
        }
        $jenis_menu =  $isi_jm; 

        if ($data["menu"] == 1 ) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 2) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 3) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 4) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 5) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 6) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 7) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 8) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 9) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 10) {
            $isi_h = "8000";
        }elseif ($data["menu"] == 11) {
            $isi_h = "10000";
        }elseif ($data["menu"] == 12) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 13) {
            $isi_h = "25000";
        }elseif ($data["menu"] == 14) {
            $isi_h = "20000";
        }elseif ($data["menu"] == 15) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 16) {
            $isi_h = "12000";
        }elseif ($data["menu"] == 17) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 18) {
            $isi_h = "17000";
        }elseif ($data["menu"] == 19) {
            $isi_h = "20000";
        }elseif ($data["menu"] == 20) {
            $isi_h = "25000";
        }elseif ($data["menu"] == 21) {
            $isi_h = "30000";
        }elseif ($data["menu"] == 22) {
            $isi_h = "15000";
        }elseif ($data["menu"] == 23) {
            $isi_h = "17000";
        }else {
            $isi_h = "12000";
        }
        $harga =  $isi_h;

        $jumlah =  $data["jumlah"];
        $m_pesanan =  $data["m_pesanan"];
        $status_pesanan =  4;
        $m_pembayaran =  $data["m_pembayaran"];
        $keterangan = $data["keterangan"];

        if ($m_pembayaran == 1) {
            $file = "tunai";
        }else {
            $file = upload_pembayarank();
            if (!$file) {
                return false; 
            }
        }
            
        $query= "UPDATE box_pmenu
                    SET
                id_m = '$id_m',
                nama = '$nama',
                email = '$email',
                menu = '$menu',
                jenis_menu = '$jenis_menu',
                harga = '$harga',
                jumlah = '$jumlah',
                m_pesanan = '$m_pesanan',
                status_pesanan = $status_pesanan,
                m_pembayaran = '$m_pembayaran',
                keterangan = '$keterangan',
                file = '$file'
                WHERE id = $id ;
                ";
    
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah boxp
    function ubah_boxp($data){
        $id = $data["id"];
        
        global $conn;
        $akun = ucwords(stripcslashes($_SESSION["user"]));
        $nama = ucwords(stripcslashes($data["nama"]));
        $email = strtolower(stripcslashes($data["email"]));
        $nohp = $data["nohp"];
        $tanggal =  $data["tanggal"];
        $jam =  $data["jam"];
        $orang =  $data["orang"];
        $keterangan =  strtolower(stripcslashes($data["keterangan"]));
        $status =  4;
        $bayar =  $data["bayar"];
        $jpaketan = $data["jpaketan"];

        if ($bayar == 1) {
            $file = "tunai";
        }else {
            $file = upload_pembayaran();
            if (!$file) {
                return false; 
            }
        }

        $create_at="current_timestamp()";
        $update_at="current_timestamp()";
            
        $query= "UPDATE box_paketan
                    SET
                nama = '$nama',
                email = '$email',
                nohp = '$nohp',
                tanggal = '$tanggal',
                jam = '$jam',
                orang = '$orang',
                keterangan = '$keterangan',
                status = $status ,
                bayar = $bayar ,
                jpaketan = $jpaketan ,
                file = '$file'
                WHERE id = $id ;
                ";
    
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

        // ubah boxp client
    function ubah_boxK($data){
        $id = $data["id"];
        
        global $conn;
        $akun = ucwords(stripcslashes($_SESSION["user"]));
        $nama = ucwords(stripcslashes($data["nama"]));
        $email = strtolower(stripcslashes($data["email"]));
        $nohp = $data["nohp"];
        $tanggal =  $data["tanggal"];
        $jam =  $data["jam"];
        $orang =  $data["orang"];
        $keterangan =  strtolower(stripcslashes($data["keterangan"]));
        $status =  4;
        $bayar =  $data["bayar"];
        $jpaketan = $data["jpaketan"];

        if ($bayar == 1) {
            $file = "tunai";
        }else {
            $file = upload_pembayarank();
            if (!$file) {
                return false; 
            }
        }

        $create_at="current_timestamp()";
        $update_at="current_timestamp()";
            
        $query= "UPDATE box_paketan
                    SET
                nama = '$nama',
                email = '$email',
                nohp = '$nohp',
                tanggal = '$tanggal',
                jam = '$jam',
                orang = '$orang',
                keterangan = '$keterangan',
                status = $status ,
                bayar = $bayar ,
                jpaketan = $jpaketan ,
                file = '$file'
                WHERE id = $id ;
                ";
    
        mysqli_query($conn, "$query");
        return mysqli_affected_rows($conn);
        }

    function konfirmasip3($id){
        global $conn;
        $id_srp = $_GET["id_srp"];
        $query= "UPDATE box_paketan
                    SET
                status =  3
                WHERE id_p = '$id_srp' ;
                ";
        
        $query2 = "UPDATE paketan
                    SET
                status =  3
                WHERE id = $id ;
                ";

        mysqli_query($conn, "$query");
        mysqli_query($conn, "$query2");
        return mysqli_affected_rows($conn);
    }

    function konfirmasipm($id){
        global $conn;
        $id_pm = $_GET["id_pm"];
        $query= "UPDATE box_pmenu
                    SET
                status_pesanan =  3
                WHERE id_pm = '$id_pm' ;
                ";
        
        $query2 = "UPDATE pesan_menu
                    SET
                status_pesanan =  3
                WHERE id = $id ;
                ";

        mysqli_query($conn, "$query");
        mysqli_query($conn, "$query2");
        return mysqli_affected_rows($conn);
    }


?>