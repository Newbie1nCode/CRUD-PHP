<?php 
   require_once '../config/database.php';

   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $gaji = $_POST['gaji'];

    $sql = "INSERT INTO employees (nama,alamat,gaji) VALUES (:nama,:alamat,:gaji)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nama' => $nama, 'alamat' => $alamat, 'gaji' => $gaji]);

    header("Location: index.php");
   }
?>

<?php include '../includes/header.php'  ?>
        
        <!-- Form Container -->
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Form Data Karyawan</h2>
            
            <form action="create.php" method="POST">
                <!-- Input Nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 text-sm font-medium mb-2">NAMA</label>
                    <input 
                        type="text"
                        name="nama" 
                        id="nama" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama lengkap">
                </div>
                
                <!-- Input Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">ALAMAT</label>
                    <input
                        name="alamat" 
                        id="alamat" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan alamat lengkap"></>
                </div>
                
                <!-- Input Gaji -->
                <div class="mb-6">
                    <label for="gaji" class="block text-gray-700 text-sm font-medium mb-2">GAJI</label>
                    <input 
                        type="number"
                        name="gaji" 
                        id="gaji" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan jumlah gaji">
                </div>
                
                <!-- Tombol Simpan -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                    SIMPAN
                </button>
            </form>
        </div>

<?php include '../includes/footer.php' ?>