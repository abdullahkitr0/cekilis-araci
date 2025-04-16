<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Çekiliş Yapma Aracı</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
  <style>
    body { font-family: "Aldrich", sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg">
    <h1 class="text-2xl font-bold text-center mb-6">🎉 Çekiliş Yapma Aracı</h1>
    <form id="update" method="post" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Kazanan Sayısı</label>
        <input name="kazanacak_sayisi" type="number" placeholder="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
      </div>

      <div class="flex items-center space-x-2">
        <input name="unique" id="unique" type="checkbox" class="w-5 h-5" />
        <label for="unique" class="text-sm">Tekrar eden katılımcılar çıkarılsın mı?</label>
      </div>
      <small id="help-unique" class="text-gray-500 text-xs hidden">Eğer bir katılımcının birden fazla çekiliş hakkı varsa bu seçeneği işaretlemeyin.</small>

      <div class="flex items-center space-x-2">
        <input name="multi" id="multi" type="checkbox" class="w-5 h-5" />
        <label for="multi" class="text-sm">Katılımcılar birden fazla hediye kazansın mı?</label>
      </div>
      <small id="help-multi" class="text-gray-500 text-xs hidden">Bir katılımcının birden fazla hediye kazanmasını istiyorsanız bu seçeneği işaretleyin.</small>

      <div>
        <label class="block text-sm font-medium mb-1">Katılımcılar (Alt alta yazınız)</label>
        <textarea name="katilimcilar" rows="8" class="w-full px-4 py-2 border rounded-lg resize-none focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
      </div>

      <button id="check_ok" type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-all">Başlat</button>
    </form>

    <div id="result" class="mt-6 text-sm whitespace-pre-line"></div>

    <div id="download-buttons" class="hidden mt-4 space-y-2 text-center">
      <button onclick="downloadPDF()" class="bg-red-600 text-white px-4 py-2 rounded-lg w-full hover:bg-red-700">📄 PDF Olarak İndir</button>
      <button onclick="downloadJSON()" class="bg-green-600 text-white px-4 py-2 rounded-lg w-full hover:bg-green-700">📁 JSON Olarak İndir</button>
      <button onclick="downloadCSV()" class="bg-yellow-500 text-white px-4 py-2 rounded-lg w-full hover:bg-yellow-600">📊 CSV Olarak İndir</button>
    </div>

    <div class="text-center mt-4">
      <a href="https://abdullahki.com/" class="text-blue-500 hover:underline text-xs">abdullahki.com</a>
    </div>
  </div>

  <script>
    let resultText = "";

    $('#check_ok').click(function () {
      $.ajax({
        type: 'POST',
        url: 'jPost.php',
        data: $("#update").serialize(),
        success: function (dt) {
          $("#result").html(dt);
          resultText = dt.replace(/<\/?[^>]+(>|$)/g, "").trim(); // HTML etiketlerini temizle
          $("#download-buttons").removeClass("hidden");
        }
      });
    });

    $("#unique").hover(function () {
      $("#help-unique").fadeIn(200);
    }, function () {
      $("#help-unique").fadeOut(100);
    });

    $("#multi").hover(function () {
      $("#help-multi").fadeIn(200);
    }, function () {
      $("#help-multi").fadeOut(100);
    });

    function downloadPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      const lines = resultText.split('\n');
      lines.forEach((line, index) => {
        doc.text(line, 10, 10 + (index * 8));
      });
      doc.save("cekilis_sonucu.pdf");
    }

    function downloadJSON() {
      const jsonBlob = new Blob([JSON.stringify({ result: resultText }, null, 2)], { type: "application/json" });
      saveAs(jsonBlob, "cekilis_sonucu.json");
    }

    function downloadCSV() {
      const csvContent = resultText.split('\n').join('\r\n');
      const csvBlob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
      saveAs(csvBlob, "cekilis_sonucu.csv");
    }
  </script>
</body>
</html>
