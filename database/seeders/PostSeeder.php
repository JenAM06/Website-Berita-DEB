<?php
// database/seeders/PostSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $posts = [
            // ── ENERGI ──────────────────────────────────────
            [
                'category' => 'energi',
                'title' => 'PLTS Off-Grid Kini Hadir di Kawasan Wisata Sawah Betapus',
                'excerpt' => 'Pembangkit Listrik Tenaga Surya (PLTS) Off-Grid resmi beroperasi di kawasan Sawah Betapus untuk mendukung lima UMKM kuliner.',
                'content' => '<p>Kawasan Wisata Sawah Betapus kini telah memiliki sistem Pembangkit Listrik Tenaga Surya (PLTS) Off-Grid yang siap mendukung aktivitas lima UMKM kuliner di sepanjang Jalan Usaha Tani, Kelurahan Lempake, Samarinda Utara.</p>
<p>Sistem PLTS ini menggunakan panel surya berkapasitas 3.480 WP, dilengkapi baterai LiFePO4 24V 400Ah, dan inverter 3.000W yang mengubah arus DC menjadi AC sehingga dapat digunakan secara fleksibel oleh seluruh peralatan listrik UMKM.</p>
<p>Dengan adanya PLTS ini, para pelaku UMKM kini dapat memperpanjang jam operasional hingga malam hari sekaligus menghemat biaya listrik secara signifikan. Program ini merupakan bagian dari Program Desa Energi Berdikari (DEB) Sobat Bumi Universitas Mulawarman yang didukung oleh Pertamina Foundation.</p>',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'category' => 'energi',
                'title' => 'Penambahan Inverter PLTS Tingkatkan Fleksibilitas Listrik UMKM Betapus',
                'excerpt' => 'Penambahan inverter pada sistem PLTS memungkinkan konversi arus DC ke AC sehingga UMKM bisa menggunakan berbagai peralatan listrik.',
                'content' => '<p>Salah satu tantangan utama pada tahun pertama program DEB adalah sistem PLTS yang masih menggunakan konfigurasi arus searah (DC). Hal ini membatasi penggunaan peralatan listrik UMKM yang sebagian besar membutuhkan arus bolak-balik (AC).</p>
<p>Pada tahun kedua, telah dilakukan penambahan inverter Kenika DC24V 3000W KCT-3K24 yang mengubah output baterai menjadi tegangan AC 220V. Kini lima warung UMKM di kawasan Betapus mendapatkan pasokan listrik dengan daya masing-masing 440W menggunakan MCB AC 2A.</p>
<p>Durasi pemakaian energi listrik yang dapat dipasok sistem PLTS ini mencapai 3 jam 42 menit per hari untuk seluruh UMKM, cukup untuk memenuhi kebutuhan operasional sore hingga malam hari ketika kawasan wisata ramai dikunjungi.</p>',
                'published_at' => Carbon::now()->subDays(5),
            ],

            // ── LINGKUNGAN ───────────────────────────────────
            [
                'category' => 'lingkungan',
                'title' => 'Bank Sampah Betapus Resmi Beroperasi dengan Gubuk Baru',
                'excerpt' => 'Pembangunan gubuk bank sampah di Kawasan Betapus menandai babak baru pengelolaan sampah berbasis masyarakat yang lebih terstruktur.',
                'content' => '<p>Bank Sampah Betapus kini semakin mantap beroperasi dengan hadirnya gubuk bank sampah permanen berukuran 6x3 meter yang berlokasi di Jl. Usaha Tani RT. 24, Kelurahan Lempake.</p>
<p>Gubuk ini menjadi pusat aktivitas pengelolaan sampah non-organik seperti pembukuan nasabah, penimbangan sampah, dan pengumpulan sampah bernilai ekonomis. Bank sampah telah resmi terbentuk melalui Surat Keputusan No. 460/002/400.09 bersama Kelurahan Lempake.</p>
<p>Pengelolaan sampah yang efektif membutuhkan struktur organisasi yang jelas dan tata kelola yang tertib. Dengan adanya bank sampah ini, diharapkan volume sampah di kawasan wisata dapat berkurang secara signifikan sekaligus membuka sumber pendapatan baru bagi masyarakat.</p>',
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'category' => 'lingkungan',
                'title' => 'Budidaya Maggot BSF: Solusi Cerdas Atasi Sampah Organik di Betapus',
                'excerpt' => 'Larva Black Soldier Fly (BSF) dimanfaatkan untuk mengurai sampah organik dari UMKM kawasan Betapus sekaligus menghasilkan produk bernilai ekonomi.',
                'content' => '<p>Kawasan Wisata Sawah Betapus menghasilkan sekitar 37,2 kg sampah organik per hari dari aktivitas 22 UMKM kuliner yang beroperasi. Potensi besar ini dimanfaatkan melalui program budidaya maggot Black Soldier Fly (BSF).</p>
<p>Maggot BSF mampu mengurai sampah organik secara efisien dengan biaya rendah dan ramah lingkungan. Selain mengurangi volume sampah, budidaya maggot menghasilkan komoditas bernilai ekonomi berupa maggot segar, maggot kering, dan kasgot (kompos maggot) yang dapat dijual sebagai pakan ternak.</p>
<p>Program ini mendukung terbentuknya ekonomi sirkular di kawasan Betapus, di mana limbah UMKM diubah menjadi sumber pendapatan baru bagi masyarakat sekitar.</p>',
                'published_at' => Carbon::now()->subDays(10),
            ],

            // ── EDUKASI ──────────────────────────────────────
            [
                'category' => 'edukasi',
                'title' => 'Goes to School: DEB Ajak Siswa SMAN 9 Samarinda Peduli Sampah',
                'excerpt' => 'Sebanyak 408 siswa SMAN 9 Samarinda mendapatkan edukasi pemilahan sampah dan pengenalan bank sampah dalam program Goes to School DEB Betapus.',
                'content' => '<p>Program edukasi Goes to School resmi dilaksanakan di SMA Negeri 9 Samarinda sebagai bagian dari pilar edukasi Program Desa Energi Berdikari (DEB). Kegiatan ini menjangkau 408 siswa dari kelas 10 dan 11 yang terbagi dalam 6 kelas.</p>
<p>Siswa mendapatkan materi tentang pemilahan sampah organik dan anorganik, pengenalan mekanisme bank sampah, serta praktik daur ulang sederhana. Kegiatan ini selaras dengan SDGs 4 (Pendidikan Berkualitas) dan SDGs 12 (Konsumsi dan Produksi Bertanggung Jawab).</p>
<p>Untuk mengukur peningkatan pemahaman, setiap peserta mengikuti pre-test sebelum kegiatan dan post-test setelah kegiatan berlangsung. Hasilnya menunjukkan peningkatan pemahaman yang signifikan terhadap pengelolaan sampah berbasis masyarakat.</p>',
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'category' => 'edukasi',
                'title' => 'Pelatihan Spin Dry Pad untuk Kelompok Tani Betapus',
                'excerpt' => 'Tiga kelompok tani di kawasan Betapus mendapatkan pelatihan penggunaan mesin Spin Dry Pad untuk pengeringan padi berbasis energi listrik terbarukan.',
                'content' => '<p>Mesin Spin Dry Pad merupakan inovasi mesin pengering padi berbasis sistem otomasi yang memanfaatkan gaya sentrifugal. Tiga kelompok tani di kawasan Betapus, yaitu Kelompok Tani Tunas Muda, Panca Karya, dan Panca Usaha, telah mengikuti pelatihan penggunaan mesin ini.</p>
<p>Berbeda dengan metode pengeringan konvensional yang bergantung pada sinar matahari, Spin Dry Pad dapat beroperasi kapan saja tanpa terpengaruh cuaca. Proses pengeringan lebih cepat dan merata, serta putaran yang terkontrol menjaga kualitas padi dari kerusakan akibat gesekan berlebih.</p>
<p>Mesin ini ditenagai oleh sistem PLTS Off-Grid yang telah terpasang di kawasan Betapus, menjadikannya solusi pertanian yang hemat energi dan ramah lingkungan.</p>',
                'published_at' => Carbon::now()->subDays(15),
            ],

            // ── EKONOMI ──────────────────────────────────────
            [
                'category' => 'ekonomi',
                'title' => 'Lima UMKM Betapus Nikmati Manfaat Energi Surya Gratis',
                'excerpt' => 'Warung Tenda Biru, Mie Ayam 2 Betapus, Dapur Elchan, Warung Daeng, dan Bakso Sri Rejeki kini menggunakan listrik dari PLTS Off-Grid secara gratis.',
                'content' => '<p>Lima UMKM kuliner di Kawasan Wisata Sawah Betapus kini resmi menjadi penerima manfaat program PLTS Off-Grid DEB Sobat Bumi. Mereka adalah Warung Tenda Biru, UMKM Mie Ayam 2 Betapus, Dapur Elchan Betapus, Warung Daeng, dan Bakso Sri Rejeki.</p>
<p>Sebelumnya, masing-masing UMKM membayar biaya listrik berkisar Rp 10.000 hingga Rp 80.000 per bulan. Dengan adanya PLTS, pengeluaran tersebut dapat ditekan signifikan. Lebih dari itu, UMKM kini dapat beroperasi lebih lama pada malam hari berkat pasokan listrik yang stabil.</p>
<p>Kawasan ini memiliki sekitar 30 UMKM kuliner aktif dengan pengunjung ramai terutama pada sore hingga malam hari di akhir pekan. Perluasan manfaat PLTS ke UMKM lainnya menjadi target pengembangan program ke depan.</p>',
                'published_at' => Carbon::now()->subDays(18),
            ],
            [
                'category' => 'ekonomi',
                'title' => 'Kasgot dan Maggot Segar: Produk Ekonomi Sirkular Andalan Betapus',
                'excerpt' => 'Hasil budidaya maggot BSF berupa maggot segar, maggot kering, dan kasgot mulai dipasarkan kepada peternak lokal sebagai sumber pendapatan komunitas.',
                'content' => '<p>Program ekonomi sirkular di Kawasan Betapus mulai menunjukkan hasil nyata. Budidaya maggot Black Soldier Fly (BSF) yang terintegrasi dengan Bank Sampah kini menghasilkan tiga produk utama: maggot segar, maggot kering, dan kasgot (kompos maggot).</p>
<p>Maggot segar dan kering diminati oleh peternak ikan dan unggas sebagai pakan alami yang kaya protein. Sementara kasgot, yang merupakan bekas media budidaya maggot, dimanfaatkan sebagai pupuk organik berkualitas tinggi bagi kelompok tani setempat.</p>
<p>Pelatihan packaging dan marketing produk maggot telah dilaksanakan untuk membekali masyarakat dengan keterampilan memasarkan produk secara lebih profesional, termasuk penggunaan standing pouch dan stiker produk yang menarik.</p>',
                'published_at' => Carbon::now()->subDays(20),
            ],

            // ── WISATA ───────────────────────────────────────
            [
                'category' => 'wisata',
                'title' => 'Sawah Betapus: Destinasi Eco-Tourism Berbasis Energi Bersih di Samarinda',
                'excerpt' => 'Kawasan Sawah Betapus berkembang menjadi destinasi wisata alam yang memadukan keindahan persawahan dengan penerapan energi terbarukan dan pengelolaan lingkungan.',
                'content' => '<p>Kawasan Wisata Sawah Betapus yang terletak di sepanjang Jalan Usaha Tani, Kelurahan Lempake, Kecamatan Samarinda Utara, kini semakin dikenal sebagai destinasi eco-tourism unggulan di Kota Samarinda.</p>
<p>Hamparan persawahan seluas 15 hektar di sisi kiri dan kanan jalan menjadi daya tarik utama, terutama pada sore hari antara pukul 15.00 hingga 18.15 WITA saat matahari terbenam menciptakan pemandangan yang memukau. Kawasan ini ramai dikunjungi terutama pada hari libur dan akhir pekan.</p>
<p>Kehadiran PLTS, Bank Sampah, dan program budidaya maggot semakin memperkuat identitas Betapus sebagai kawasan wisata berkelanjutan yang tidak hanya indah secara visual, tetapi juga ramah lingkungan dan memberdayakan ekonomi masyarakat lokal.</p>',
                'published_at' => Carbon::now()->subDays(22),
            ],
            [
                'category' => 'wisata',
                'title' => 'Penanaman 50 Pohon Produktif Perindah Kawasan Wisata Betapus',
                'excerpt' => 'Sebanyak 25 pohon rambutan dan 25 pohon mangga ditanam di kawasan Betapus untuk memperindah lingkungan sekaligus menyerap 5.250 kg CO2 per tahun.',
                'content' => '<p>Program penghijauan kawasan Wisata Sawah Betapus resmi dimulai dengan penanaman 50 pohon produktif yang terdiri dari 25 pohon rambutan dan 25 pohon mangga. Kegiatan ini melibatkan mahasiswa, masyarakat setempat, dan pengelola program DEB.</p>
<p>Pemilihan pohon rambutan dan mangga bukan tanpa alasan. Selain memperindah kawasan wisata, kedua jenis pohon ini memiliki kemampuan penyerapan karbon dioksida yang signifikan. Pohon rambutan menyerap sekitar 157 kg CO2 per tahun, sementara pohon mangga menyerap 53 kg CO2 per tahun. Total reduksi emisi dari program penanaman ini mencapai 5.250 kg CO2 per tahun.</p>
<p>Dalam jangka panjang, pohon-pohon ini juga akan menghasilkan buah yang dapat menambah daya tarik wisata dan menjadi sumber pendapatan tambahan bagi masyarakat sekitar kawasan Betapus.</p>',
                'published_at' => Carbon::now()->subDays(25),
            ],
        ];

        foreach ($posts as $postData) {
            $category = Category::where('slug', $postData['category'])->first();

            Post::create([
                'user_id'      => $admin->id,
                'category_id'  => $category->id,
                'title'        => $postData['title'],
                'slug'         => \Illuminate\Support\Str::slug($postData['title']),
                'excerpt'      => $postData['excerpt'],
                'content'      => $postData['content'],
                'image'        => null,
                'status'       => 'published',
                'published_at' => $postData['published_at'],
            ]);
        }
    }
}