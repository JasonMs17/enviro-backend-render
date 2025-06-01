<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path ke file JSON Anda
        $jsonPath = database_path('data/output.json');

        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $materials = json_decode($jsonContent, true);

            if (is_array($materials)) {
                $dataToInsert = [];
                foreach ($materials as $material) {
                    $dataToInsert[] = [
                        'bab' => $material['bab'] ?? null,
                        'pollution_type_id' => $material['pollution_type_id'] ?? null,
                        'sub_bab' => $material['sub_bab'] ?? null,
                        'title' => $material['title'] ?? null,
                        'content' => $material['content'] ?? null,
                        'detail' => $material['detail'] ?? null,
                        'video_subs' => $material['video_subs'] ?? null,
                        'photo' => $material['photo'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if (!empty($dataToInsert)) {
                    DB::table('materials')->insert($dataToInsert);
                    $this->command->info('Data materi berhasil diimpor dari JSON.');
                } else {
                    $this->command->warn('Tidak ada data materi untuk diimpor dari JSON.');
                }
            } else {
                $this->command->error('Format file JSON tidak valid.');
            }
        } else {
            $this->command->error("File JSON tidak ditemukan di: {$jsonPath}");
        }
    }
}

// <?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

// class MaterialSeeder extends Seeder
// {
//     public function run()
//     {
//         DB::table('materials')->insert([
//             ['bab' => 'Sub bab 1 Materi 1', 'pollution_type_id' => 1, 'title' => 'Apa Itu Polusi Air?', 'content' => 'Polusi air adalah kondisi saat air tercemar zat berbahaya—dari limbah pabrik, pertanian, hingga aktivitas rumah tangga—yang menurunkan kualitasnya untuk kehidupan. Ciri air tercemar bisa terlihat dari perubahan warna, bau, pH, hingga munculnya mikroorganisme berbahaya. Jenis polusi air meliputi pencemaran mikrobiologis, kimia organik dan anorganik, termal, sedimen, serta eutrofikasi akibat kelebihan nutrisi.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 2', 'pollution_type_id' => 1, 'title' => 'Penyebab Polusi Air', 'content' => 'Polusi air muncul dari banyak sumber: limbah industri (logam berat, bahan kimia beracun), limbah rumah tangga (sabun, deterjen), pertanian (pupuk & pestisida), tambang (air asam tambang), urbanisasi (limbah konstruksi), transportasi laut (tumpahan minyak), hingga perubahan iklim (suhu air naik & pola hujan berubah). Semua faktor ini memperparah pencemaran dan merusak kualitas air.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 3', 'pollution_type_id' => 1, 'title' => 'Dampak Umum Polusi Air', 'content' => 'Polusi air berdampak besar: ekosistem air rusak, rantai makanan terganggu, dan kesehatan manusia terancam oleh penyakit hingga keracunan kimia. Secara ekonomi, biaya pengolahan air naik, sektor perikanan dan pariwisata merugi. Pertanian juga terdampak, hasil panen bisa terkontaminasi. Krisis air bersih meningkat, memicu konflik sosial dan memperparah ketimpangan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 1', 'pollution_type_id' => 1, 'title' => 'Air Tercemar dan Penyakit', 'content' => 'Air yang terlihat bersih belum tentu aman—air tercemar bisa membawa bakteri, virus, dan zat berbahaya yang menyebabkan penyakit seperti diare, kolera, tipes, hepatitis A, iritasi kulit, hingga kanker. Anak-anak dan kelompok rentan paling berisiko jika terpapar air kotor dalam aktivitas sehari-hari.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 2', 'pollution_type_id' => 1, 'title' => 'Siapa yang Paling Terdampak?', 'content' => 'Krisis air tercemar paling berat dirasakan oleh anak-anak, lansia, dan masyarakat di wilayah dengan akses air bersih terbatas. Setiap harinya, ribuan anak meninggal akibat penyakit air, sementara ketimpangan akses memperburuk siklus kemiskinan dan penyakit di komunitas rentan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 3', 'pollution_type_id' => 1, 'title' => 'Menentukan Air Aman Dikonsumsi', 'content' => 'Air yang jernih belum tentu aman—harus dicek dari warna, bau, rasa, hingga kandungan zat berbahaya seperti logam berat dan bakteri. Pemeriksaan fisik, kimia, mikrobiologis, serta pengecekan sumber air sangat penting untuk memastikan air layak konsumsi dan aman untuk kesehatan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 1', 'pollution_type_id' => 1, 'title' => 'Pengolahan Limbah Air', 'content' => 'Air limbah dari rumah atau pabrik tidak langsung dibuang ke sungai, melainkan melalui serangkaian proses pengolahan: mulai dari pengumpulan, penyaringan kasar, pengendapan, pembersihan biologis dengan mikroorganisme, hingga disinfeksi. Setelah dinyatakan bersih, air olahan baru boleh dilepas kembali ke lingkungan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 2', 'pollution_type_id' => 1, 'title' => 'Aksi Individu untuk Menjaga Air', 'content' => 'Setiap orang bisa berkontribusi menjaga air bersih dengan langkah sederhana: hemat air sehari-hari, hindari buang sampah ke sungai, kurangi plastik sekali pakai, serta edukasi diri dan orang sekitar tentang pentingnya menjaga sumber air dari pencemaran.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 3', 'pollution_type_id' => 1, 'title' => 'Pengelolaan Air Berkelanjutan', 'content' => 'Pengelolaan air berkelanjutan dimulai dari hemat air di rumah, mengelola limbah dengan benar, mendukung teknologi pengolahan air bersih, menjaga sumber air alami seperti sungai dan danau, serta mengajak komunitas sekitar untuk peduli terhadap isu air bersih.', 'created_at' => now(), 'updated_at' => now()],
//             // --- Polusi Udara
//             ['bab' => 'Sub bab 1 Materi 1', 'pollution_type_id' => 2, 'title' => 'Apa Itu Polusi Udara dan Sumbernya', 'content' => 'Polusi udara terjadi saat udara tercampur zat berbahaya dari sumber alami seperti letusan gunung dan buatan seperti asap kendaraan, yang bisa mengancam kesehatan manusia dan lingkungan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 2', 'pollution_type_id' => 2, 'title' => 'Jenis Polutan di Udara', 'content' => 'Polusi udara dibedakan menjadi polutan primer yang langsung dilepas dari sumber (seperti CO dan SO₂) dan polutan sekunder yang terbentuk dari reaksi kimia di atmosfer (seperti ozon troposferik dan smog), keduanya berbahaya bagi kesehatan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 3', 'pollution_type_id' => 2, 'title' => 'Dampak Polusi terhadap Lingkungan', 'content' => 'Polusi udara merusak lingkungan dengan menipiskan lapisan ozon, mempercepat pemanasan global, menyebabkan hujan asam yang merusak tanah dan air, serta meningkatkan kejadian cuaca ekstrem di seluruh dunia.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 1', 'pollution_type_id' => 2, 'title' => 'Bagaimana Polusi Udara Mempengaruhi Tubuh Kita', 'content' => 'Polusi udara dapat merusak sistem pernapasan, jantung, dan otak, meningkatkan risiko asma, penyakit jantung, dan gangguan kognitif.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 2', 'pollution_type_id' => 2, 'title' => 'Pencegahan & Penanganan Risiko Kesehatan Akibat Polusi', 'content' => 'Lindungi diri dengan masker N95, air purifier, memeriksa kualitas udara, dan menjaga kesehatan tubuh dengan tidur cukup serta makan makanan bergizi.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 3', 'pollution_type_id' => 2, 'title' => 'Siapa yang Paling Terdampak?', 'content' => 'Anak-anak, lansia, dan penderita penyakit kronis paling rentan terhadap dampak polusi udara, dengan risiko gangguan pernapasan, jantung, dan komplikasi kesehatan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 1', 'pollution_type_id' => 2, 'title' => 'Inovasi di Kota-Kota Besar untuk Mengatasi Polusi Udara', 'content' => 'Kota-kota besar seperti Seoul, London, Delhi, dan Jakarta kini berinovasi untuk mengatasi polusi udara melalui ruang hijau, zona emisi rendah, transportasi ramah lingkungan, dan program pembatasan industri, dengan hasil peningkatan kualitas udara dan kesehatan publik.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 2', 'pollution_type_id' => 2, 'title' => 'Peran Pemerintah dan Regulasi', 'content' => 'Pemerintah mengatur emisi kendaraan, pabrik, dan industri melalui standar ketat untuk mengurangi polusi udara, memastikan kualitas udara yang lebih baik dan kesehatan masyarakat melalui regulasi emisi, pengelolaan limbah industri, dan promosi transportasi ramah lingkungan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 3', 'pollution_type_id' => 2, 'title' => 'Aksi Individu untuk Udara Lebih Bersih', 'content' => 'Individu dapat membantu mengurangi polusi udara dengan mengurangi penggunaan kendaraan pribadi, menanam pohon, dan menyebarkan kesadaran lingkungan, yang akan meningkatkan kualitas udara, kesehatan tubuh, dan menciptakan perubahan kolektif untuk lingkungan yang lebih bersih.', 'created_at' => now(), 'updated_at' => now()],
//             // --- Polusi Tanah
//             ['bab' => 'Sub bab 1 Materi 1', 'pollution_type_id' => 3, 'title' => 'Apa Itu Polusi Tanah & Penyebabnya', 'content' => 'Polusi tanah terjadi ketika tanah tercemar oleh zat berbahaya, mengganggu kesuburan dan kesehatan tanah. Penyebabnya meliputi kebocoran limbah cair, tumpahan bahan kimia, dan penggunaan pestisida serta pupuk berlebihan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 2', 'pollution_type_id' => 3, 'title' => 'Dampak Polusi Tanah terhadap Lingkungan', 'content' => 'Polusi tanah menurunkan kesuburan, merusak ekosistem, dan mengganggu pertumbuhan tanaman. Dampaknya termasuk menurunnya produktivitas tanah, hilangnya nutrisi, kerusakan ekosistem, dan pencemaran udara.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Materi 3', 'pollution_type_id' => 3, 'title' => 'Jenis-Jenis Limbah Penyebab Polusi Tanah', 'content' => 'Limbah domestik (plastik, detergen), limbah pabrik (limbah kimia), dan limbah pertanian (pupuk, pestisida) adalah penyebab utama polusi tanah, yang merusak struktur dan kesuburan tanah.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 1', 'pollution_type_id' => 3, 'title' => 'Zat Berbahaya yang Terkandung dalam Tanah Tercemar', 'content' => 'Tanah yang tercemar mengandung zat berbahaya seperti timbal, arsenik, dan merkuri, yang dapat merusak lingkungan dan mengancam kesehatan manusia. Zat-zat ini bisa bertahan lama di tanah dan masuk ke dalam tubuh melalui tanaman atau air tanah yang tercemar, menyebabkan kerusakan pada tanah dan ekosistem.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 2', 'pollution_type_id' => 3, 'title' => 'Risiko Kesehatan Akibat Polusi Tanah', 'content' => 'Polusi tanah mengancam kesehatan dengan mengganggu sistem saraf, meningkatkan risiko kanker, menyebabkan penyakit kulit, dan gangguan reproduksi. Paparan terhadap logam berat dan bahan kimia berbahaya dapat merusak organ tubuh dan memengaruhi perkembangan otak, terutama pada anak-anak.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Materi 3', 'pollution_type_id' => 3, 'title' => 'Kontaminasi pada Tanaman & Dampaknya ke Manusia', 'content' => 'Tanaman yang tumbuh di tanah tercemar dapat menyerap zat berbahaya seperti logam berat, yang kemudian masuk ke tubuh manusia melalui konsumsi. Ini meningkatkan risiko gangguan kesehatan jangka panjang, termasuk kerusakan organ dan kanker.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 1', 'pollution_type_id' => 3, 'title' => 'Pengelolaan Sampah & Limbah Rumah Tangga', 'content' => 'Pemilahan sampah (organik, anorganik, B3) penting untuk mengurangi pencemaran tanah. Daur ulang dan hindari membuang sampah sembarangan.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 2', 'pollution_type_id' => 3, 'title' => 'Teknologi Pengendalian & Pemulihan Tanah', 'content' => 'Metode pemulihan tanah seperti bioremediasi (mikroorganisme), fitoremediasi (tanaman), dan remediasi termal dapat mengurangi pencemaran tanah.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Materi 3', 'pollution_type_id' => 3, 'title' => 'Peran Masyarakat & Edukasi Lingkungan', 'content' => 'Masyarakat berperan penting dalam mengatasi polusi tanah melalui urban farming, kampanye di sekolah, dan bank sampah.', 'created_at' => now(), 'updated_at' => now()],
//             // --- Quiz
//             ['bab' => 'Sub bab 1 Kuis 1', 'pollution_type_id' => 1, 'title' => 'Pengenalan Polusi Air & Dampak Umum', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Kuis 1', 'pollution_type_id' => 1, 'title' => 'Penyebab Polusi Air & Dampaknya terhadap Kesehatan', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Kuis 1', 'pollution_type_id' => 1, 'title' => 'Solusi Menjaga Kualitas Air', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Kuis 2', 'pollution_type_id' => 2, 'title' => 'Pengenalan Polusi Udara & Dampaknya terhadap Lingkungan', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Kuis 2', 'pollution_type_id' => 2, 'title' => 'Dampak Polusi Udara terhadap Kesehatan', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Kuis 2', 'pollution_type_id' => 2, 'title' => 'Solusi dan Upaya Penanggulangan', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 1 Kuis 3', 'pollution_type_id' => 3, 'title' => 'Pengenalan Polusi Tanah & Penyebabnya', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 2 Kuis 3', 'pollution_type_id' => 3, 'title' => 'Dampak Polusi Tanah terhadap Kesehatan', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//             ['bab' => 'Sub bab 3 Kuis 3', 'pollution_type_id' => 3, 'title' => 'Solusi Mengatasi Polusi Tanah', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'created_at' => now(), 'updated_at' => now()],
//         ]);
//     }
// }
