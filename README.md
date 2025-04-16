# 🎉 Çekiliş Yapma Aracı

Bu proje, katılımcılar arasından rastgele kazanan(lar) belirlemek için geliştirilmiş bir web tabanlı çekiliş uygulamasıdır. Modern arayüzü ve PDF, JSON, CSV dışa aktarma desteğiyle kullanımı oldukça kolaydır.

## 🚀 Özellikler

- Katılımcıları liste halinde girerek çekiliş yapma
- Kazanan sayısını belirleyebilme
- Tekrar eden katılımcıları çıkarma seçeneği
- Katılımcıların birden fazla hediye kazanmasına izin verme
- Sonuçları:
  - PDF formatında indirme
  - JSON formatında indirme
  - CSV formatında indirme
- Mobil uyumlu arayüz (Tailwind CSS ile)
- jQuery üzerinden AJAX ile hızlı yanıt alma

---

## 📁 Dosya Yapısı

/
├── index.php         # Ana arayüz ve kullanıcı girişi
├── jPost.php         # Çekilişi yapan backend PHP dosyası
├── README.md         # Bu dökümantasyon

---

## 🛠️ Kurulum

1. Bu projeyi indir veya klonla:
git clone [https://github.com/abdullahkitr0/cekilis-araci.git](https://github.com/abdullahkitr0/cekilis-araci.git)
2. Web sunucunuza yükleyin (`index.php` ve `jPost.php` aynı dizinde olacak şekilde).
3. Tarayıcınızdan `index.php` dosyasını açarak uygulamayı kullanmaya başlayın.

---

## 🧪 Kullanım

### 1. Katılımcı Listesini Girin
- Katılımcıları alt alta (her satıra bir kişi) olacak şekilde metin kutusuna yazın.

### 2. Ayarları Yapılandırın
- ✅ Kazanan Sayısı: Kaç kişinin kazanacağını belirleyin.
- ✅ Tekrar Eden Katılımcılar: Aynı kişinin birden fazla hakkı varsa işaretlemeyin.
- ✅ Birden Fazla Kazanım: Aynı kişi birden fazla ödül kazanabilsin mi?

### 3. Çekilişi Başlat
- "Başlat" butonuna tıklayın.
- Sonuçlar sayfada listelenir.

### 4. Sonucu İndir
- PDF, JSON veya CSV olarak sonucu indirebilirsiniz.

---

## 🔍 Teknik Detaylar

### Frontend
- HTML5 / Tailwind CSS: Responsive arayüz
- JavaScript (jQuery): AJAX istekleri
- jsPDF: PDF çıktısı
- FileSaver.js: JSON ve CSV indirme desteği

### Backend (jPost.php)
- Katılımcı listesi ve çekiliş ayarlarını alır.
- Girişleri filtreleyip doğrular.
- Rastgele kazananları belirler.
- HTML formatında sonucu döner.

#### İşleyiş Akışı:
1. Form, AJAX ile `jPost.php` dosyasına POST isteği gönderir.
2. PHP dosyası gelen verileri kontrol eder:
   - Kazanan sayısı geçerli mi?
   - Katılımcı sayısı yeterli mi?
   - Tekrar edenleri ayıkla (isteğe göre)
3. `rand()` fonksiyonu ile rastgele kazanan(lar) belirlenir.
4. HTML formatında yanıt döner.
5. JavaScript, bu sonucu kullanıcıya gösterir ve dışa aktarma fonksiyonlarını aktif eder.

---

## 📦 Örnek Kullanım

### Katılımcı Listesi (Örnek):
Ali
Ayşe
Fatma
Ali
Mehmet
Zeynep

### Ayarlar:
- Kazanan Sayısı: `2`
- Tekrar Edenleri Çıkar: ✅
- Birden Fazla Kazanım: ❌

### Olası Sonuç:
Çekilişe Katılan: 5 Kişi
Toplam Çekiliş Hakkı: 6 Adet
Çekiliş Tarihi: 15-04-2025 20:25

🎁 Kazananlar:
1. Zeynep
2. Ali

---

## 📥 İndirilebilir Dosyalar

| Format | İçerik                | Kullanım Amacı             |
|--------|-----------------------|----------------------------|
| PDF    | Kazananları gösteren belge | Paylaşım veya çıktı alma   |
| JSON   | `{ "result": "..."}`  | API ile kullanım / yedekleme |
| CSV    | `1.,2.,3.` listesi   | Excel veya tabloya aktarma |

---

## 🧑‍💻 Geliştirici Notları
- Sunucu tarafında kullanıcı girişi veya IP kontrolü bulunmamaktadır.
- Kodlarda herhangi bir veritabanı bağlantısı kullanılmaz.
- Kodlar sade ve geliştirilebilir yapıdadır.

---

## 📄 Lisans
Bu proje MIT lisansı ile lisanslanmıştır. Dilediğiniz gibi kullanabilir, geliştirebilir ve paylaşabilirsiniz.

---

## 🙋‍♂️ Destek

Eğer benimle iletişime geçmek isterseniz, aşağıdaki bağlantılardan ulaşabilirsiniz:

- **Web Sitem:** [www.abdullahki.com](https://abdullahki.com)
- **Instagram:** [@abdullah.kvrak](https://www.instagram.com/abdullah.kvrak)
- **GitHub:** [abdullahkitr0](https://github.com/abdullahkitr0)
- **Linkedin:** [abdullahki](https://www.linkedin.com/in/abdullahki)

Yeni özellik önerilerin varsa memnuniyetle dinlerim!
