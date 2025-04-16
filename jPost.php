<?php 
date_default_timezone_set("Europe/Istanbul");

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Girdi Kontrolleri
$katilimcilar_raw = $_POST['katilimcilar'] ?? '';
$kazanacak_sayisi_raw = $_POST['kazanacak_sayisi'] ?? 0;
$kazanacak_sayisi = filter_var($kazanacak_sayisi_raw, FILTER_VALIDATE_INT);

if (!$kazanacak_sayisi || $kazanacak_sayisi < 1) {
    exit("Geçerli bir kazanan sayısı giriniz.");
}

$katilimcilar = array_filter(array_map('sanitize_input', explode("\r\n", $katilimcilar_raw)));
$katilimcilar = array_values($katilimcilar); // Boşlar temizlenir

if (isset($_POST["unique"])) {
    $katilimcilar = array_unique($katilimcilar);
}

$total_entries = count($katilimcilar);
$unique_entries = count(array_unique($katilimcilar));

// Eğer katılımcı yetersizse
if ($kazanacak_sayisi > $total_entries) {
    exit("Kazanacak sayısı, katılımcı sayısından daha fazla olamaz.");
}

$allow_multiple_wins = isset($_POST["multi"]);
$winners = [];
$kontrol = [];

for ($i = 1; $i <= $kazanacak_sayisi; $i++) {
    $index = rand(0, $total_entries - 1);
    $selected = $katilimcilar[$index];

    if (!$allow_multiple_wins && in_array($selected, $winners)) {
        $i--;
        continue;
    }

    if (!$allow_multiple_wins && in_array($index, $kontrol)) {
        $i--;
        continue;
    }

    $winners[] = $selected;
    $kontrol[] = $index;
}

// HTML Sonuç
echo "<div class='text-left'>";
echo "<p><strong>Çekilişe Katılan:</strong> $unique_entries Kişi</p>";
echo "<p><strong>Toplam Çekiliş Hakkı:</strong> $total_entries Adet</p>";
echo "<p><strong>Çekiliş Tarihi:</strong> " . date("d-m-Y H:i") . "</p>";
echo "<hr class='my-2' />";
echo "<h2 class='text-lg font-bold mb-2'>🎁 Kazananlar:</h2>";
echo "<ul class='list-disc pl-5 space-y-1'>";
foreach ($winners as $key => $win) {
    echo "<li><strong>" . ($key + 1) . ".</strong> $win</li>";
}
echo "</ul>";
echo "</div>";
?>
