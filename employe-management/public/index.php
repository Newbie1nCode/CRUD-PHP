<?php 
require_once '../config/database.php';
include '../includes/header.php';

$sql = "SELECT * FROM employees";
$stmt = $pdo->query($sql);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Karyawan</h1>
    


    <a href="create.php" class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Tambah Karyawan
    </a>
    <table class="min-w-full bg-white rounded-lg overflow-hidden">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/4 px-6 py-3 text-left">Nama</th>
                <th class="w-1/4 px-6 py-3 text-left">Alamat</th>
                <th class="w-1/4 px-6 py-3 text-left">Gaji</th>
                <th class="w-1/4 px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php foreach($employees as $employee): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border px-6 py-4"><?= htmlspecialchars($employee['nama'] ?? '') ?></td>
                    <td class="border px-6 py-4"><?= htmlspecialchars($employee['alamat'] ?? '') ?></td>
                    <td class="border px-6 py-4">Rp <?= isset($employee['gaji']) ? number_format($employee['gaji'], 0, ',', '.') : '0' ?></td>
                    <td class="border px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="update.php?id=<?= $employee['id'] ?>" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm transition duration-200">
                                Edit
                            </a>
                            <a href="delete.php?id=<?= $employee['id'] ?>" 
                               class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition duration-200"
                               onclick="return confirm('Yakin ingin menghapus?')">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php' ?>