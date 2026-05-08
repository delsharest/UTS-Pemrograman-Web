<?php 
include 'koneksi.php';
$id = $_GET['id'] ?? null;
$data = ['nim' => '', 'nama' => '', 'jurusan' => '', 'foto' => ''];

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Mahasiswa</title>
</head>
<body>
    <h2><?= $id ? "Edit" : "Tambah" ?> Mahasiswa</h2>
    <form action="proses.php" method="POST" enctype="multipart/form-data" id="mhsForm">
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <label>NIM:</label><br>
        <input type="text" name="nim" id="nim" value="<?= $data['nim'] ?>"><br><br>
        
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>"><br><br>
        
        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" id="jurusan" value="<?= $data['jurusan'] ?>"><br><br>
        
        <label>Foto:</label><br>
        <?php if($id) echo "<img src='uploads/".$data['foto']."' width='50'><br>"; ?>
        <input type="file" name="foto" id="foto"><br><br>
        
        <button type="submit" name="simpan">Simpan Data</button>
        <a href="index.php">Kembali</a>
    </form>

    <script>
    document.getElementById('mhsForm').onsubmit = function(e) {
        const nim = document.getElementById('nim').value;
        const nama = document.getElementById('nama').value;
        const jurusan = document.getElementById('jurusan').value;
        const foto = document.getElementById('foto');
        const isEdit = "<?= $id ?>";

        if (!nim || !nama || !jurusan) {
            alert("Semua field teks wajib diisi!");
            return false;
        }

        if (!isEdit && foto.files.length === 0) {
            alert("Foto wajib diunggah!");
            return false;
        }

        if (foto.files.length > 0) {
            const file = foto.files[0];
            const type = file.type;
            const size = file.size;

            if (!['image/jpeg', 'image/jpg', 'image/png'].includes(type)) {
                alert("Format harus JPG/JPEG/PNG!");
                return false;
            }
            if (size > 2 * 1024 * 1024) {
                alert("Ukuran maksimal 2 MB!");
                return false;
            }
        }
    };
    </script>
</body>
</html>

<style>
    body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
    .container { max-width: 500px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    input[type="text"], input[type="file"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
    button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
    button:hover { background: #0056b3; }
    .back-link { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; }
</style>