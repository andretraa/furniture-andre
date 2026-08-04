<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Kisah Pengrajin DrewWood: Mengubah Kayu Jati Pilihan Menjadi Mahakarya Ekspor',
                'slug' => 'kisah-pengrajin-drewwood-mahakarya-ekspor',
                'category' => 'Profil Perusahaan',
                'excerpt' => 'Pelajari perjalanan panjang DrewWood dalam menghadirkan furniture kayu jati kualitas terbaik dari Parongpong ke seluruh Indonesia dan mancanegara.',
                'content' => '
                    <p>DrewWood didirikan atas dasar kecintaan terhadap seni pertukangan kayu (*woodcraft*) autentik khas Indonesia. Berawal dari workshop sederhana di kawasan Parongpong, kami senantiasa menjaga nilai-nilai keahlian pengrajin lokal yang dikombinasikan dengan teknik pengeringan (*kiln-dry*) modern standar ekspor.</p>

                    <h3>Dedikasi Terhadap Kualitas Kayu Jati TPK Grade A</h3>
                    <p>Setiap lembar kayu jati yang kami gunakan bersumber langsung dari perhutani resmi (TPK Grade A). Proses seleksi dilakukan secara ketat untuk memastikan serat kayu yang rapat, kandungan minyak alami yang tinggi, dan keawetan konstruksi hingga puluhan tahun.</p>

                    <p>Bagi kami, membuat furniture bukan sekadar memotong dan menyambungkan kayu, melainkan menciptakan karya seni yang memberikan kenyamanan, estetika, dan kehangatan di setiap sudut rumah Anda.</p>

                    <h3>Filosofi Desain Modern & Ergonomis</h3>
                    <p>Desain produk DrewWood menggabungkan estetika Scandinavia, Japandi, dan elemen tradisional Indonesia. Kami memperhatikan setiap detail lengkungan ergonomis sehingga tidak hanya memanjakan mata, tetapi juga sangat nyaman saat digunakan sehari-hari.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Pendiri DrewWood',
                'read_time' => '4 min baca',
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Panduan Lengkap Memilih Kayu Jati Premium untuk Meja Makan & Sofa',
                'slug' => 'panduan-memilih-kayu-jati-premium',
                'category' => 'Panduan Kayu',
                'excerpt' => 'Ketahui perbedaan kayu jati Grade A, B, dan C serta tips membedakan kayu jati asli sebelum membeli furniture untuk hunian Anda.',
                'content' => '
                    <p>Kayu Jati (*Tectona grandis*) dikenal sebagai raja kayu untuk pembuatan furniture karena ketahanannya terhadap cuaca, rayap, dan kelembapan. Namun, tidak semua kayu jati yang beredar di pasaran memiliki kualitas yang sama.</p>

                    <h3>1. Mengenal Ciri Kayu Jati Grade A (TPK)</h3>
                    <p>Kayu Jati Grade A diambil dari bagian inti batang pohon jati (*heartwood*) yang berumur di atas 30-40 tahun. Ciri utamanya meliputi warna cokelat keemasan seragam, serat kayu yang rapat dan lurus, serta kandungan minyak alami yang tinggi sehingga terasa halus dan tidak mudah pecah.</p>

                    <h3>2. Pentingnya Oven Kayu (*Kiln-Dried*)</h3>
                    <p>Sebelum diproses menjadi meja makan atau tempat tidur, kayu jati harus melalui pengeringan oven (*kiln-dry*) hingga kadar airnya (*moisture content*) di bawah 12%. Hal ini mencegah kayu menyusut atau melengkung saat berada di ruangan ber-AC.</p>

                    <h3>3. Perawatan Finishing Alami</h3>
                    <p>Gunakan *teak oil* atau *wax* berkualitas setiap 6-12 bulan sekali untuk mempertahankan kehangatan warna alami kayu jati Anda.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1615066390971-03e4e1c36ddf?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Tim Kayu DrewWood',
                'read_time' => '5 min baca',
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Tren Desain Interior Japandi 2026: Sentuhan Alami & Minimalis Hangat',
                'slug' => 'tren-desain-interior-japandi-2026',
                'category' => 'Desain Interior',
                'excerpt' => 'Perpaduan gaya Jepang (Wabi-Sabi) dan Scandinavian yang menciptakan hunian tenang, rapi, dan penuh fungsionalitas.',
                'content' => '
                    <p>Gaya desain interior **Japandi** (Japanese + Scandinavian) terus menjadi tren terpopuler di tahun 2026. Gaya ini mengedepankan kesederhanaan, kepraktisan, serta penggunaan elemen material alami seperti kayu oak, jati, kain linen, dan tanaman hias.</p>

                    <h3>Kunci Utama Menciptakan Ruang Bergaya Japandi:</h3>
                    <ul>
                        <li><strong>Warna Netral & Warm Tone:</strong> Gunakan palet warna krem, beige, kayu hangat, dan sentuhan hijau daun.</li>
                        <li><strong>Furniture Berprofil Rendah (*Low-Profile*):</strong> Pilih tempat tidur platform atau sofa rendah dengan kaki kayu yang clean.</li>
                        <li><strong>Penyimpanan Tersembunyi:</strong> Pastikan ruangan tetap rapi dengan meletakkan penyimpanan serbaguna yang minimalis.</li>
                    </ul>

                    <p>Di DrewWood, koleksi seperti <em>Kyoto Platform Bed</em> dan <em>Nordic Soft Sofa</em> dirancang khusus untuk memadukan estetika Japandi ini secara sempurna ke dalam rumah modern.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Desainer Interior DrewWood',
                'read_time' => '4 min baca',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'Cara Merawat Furniture Kayu Mahoni & Velvet Agar Tetap Awet Berseka',
                'slug' => 'cara-merawat-furniture-kayu-mahoni-velvet',
                'category' => 'Tips & Trik',
                'excerpt' => 'Langkah-langkah praktis dan sederhana membersihkan noda kain velvet serta merawat kilau finishing kayu mahoni rumah Anda.',
                'content' => '
                    <p>Furniture dengan kombinasi kayu mahoni solid dan kain velvet menghadirkan nuansa kemewahan yang tiada tanding. Agar keindahannya bertahan lama, berikut tips perawatan harian dari pakar DrewWood:</p>

                    <h3>1. Membersihkan Kain Velvet</h3>
                    <p>Gunakan penyedot debu (*vacuum cleaner*) dengan sikat lembut seminggu sekali untuk mengangkat debu di sela-sela jahitan sofa. Jika terkena tumpahan cairan, segera tepuk-tepuk dengan kain kain mikro fiber kering (jangan digosok agar serat kain tidak rusak).</p>

                    <h3>2. Menjaga Kilau Kayu Mahoni</h3>
                    <p>Hindari meletakkan furniture kayu langsung di bawah paparan sinar matahari terik secara terus-menerus. Bersihkan permukaan kayu dengan kain lembap, lalu keringkan dengan kain lap lembut.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Tim Layanan Pelanggan',
                'read_time' => '3 min baca',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(12),
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
