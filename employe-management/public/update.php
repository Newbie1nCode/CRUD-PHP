<?php 
require_once '../config/database.php';
include '../includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID tidak valid");
}

$sql = "SELECT * FROM employees WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    die("Data karyawan tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $gaji = $_POST['gaji'];
    $id = $_POST['id']; // Ambil ID dari form

    $sql = "UPDATE employees SET nama = :nama, alamat = :alamat, gaji = :gaji WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        'nama' => $nama,
        'alamat' => $alamat, 
        'gaji' => $gaji,
        'id' => $id
    ]);

    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative'>Gagal update data</div>";
    }
}
?>

<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Data Karyawan</h2>
    
    <form method="POST">
        <!-- Input hidden untuk ID -->
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <!-- Input Nama -->
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-medium mb-2">NAMA</label>
            <input 
                value="<?= htmlspecialchars($employee['nama'] ?? '') ?>"
                type="text"
                name="nama" 
                id="nama" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan nama lengkap">
        </div>
        
        <!-- Input Alamat -->
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">ALAMAT</label>
            <textarea
                name="alamat" 
                id="alamat" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($employee['alamat'] ?? '') ?></textarea>
        </div>
        
        <!-- Input Gaji -->
        <div class="mb-6">
            <label for="gaji" class="block text-gray-700 text-sm font-medium mb-2">GAJI</label>
            <input 
                value="<?= htmlspecialchars($employee['gaji'] ?? '') ?>"
                type="number"
                name="gaji" 
                id="gaji" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan jumlah gaji">
        </div>
        
        <button 
            type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
            UPDATE
        </button>
    </form>
</div>

<?php include '../includes/footer.php' ?>