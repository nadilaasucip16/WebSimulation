<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skenario;

class SkenarioSeeder extends Seeder
{
    public function run(): void
    {
        $skenarios = [
            [
                'judul'      => 'Enkapsulasi: Rekening Bank',
                'deskripsi'  => 'Pelajari konsep enkapsulasi dengan class RekeningBank yang melindungi data saldo dari akses langsung luar class menggunakan atribut private.',
                'materi'     => 'enkapsulasi',
                'urutan'     => 1,
                'aktif'      => true,
                'kode_python' => <<<'PYTHON'
class RekeningBank:
    def __init__(self, pemilik, saldo_awal):
        self.__pemilik = pemilik      # private
        self.__saldo = saldo_awal     # private

    def get_pemilik(self):
        return self.__pemilik

    def get_saldo(self):
        return self.__saldo

    def setor(self, jumlah):
        if jumlah > 0:
            self.__saldo += jumlah
            print(f"Setor Rp{jumlah:,} berhasil. Saldo: Rp{self.__saldo:,}")

    def tarik(self, jumlah):
        if jumlah <= self.__saldo:
            self.__saldo -= jumlah
            print(f"Tarik Rp{jumlah:,} berhasil. Saldo: Rp{self.__saldo:,}")
        else:
            print("Saldo tidak mencukupi!")

# Uji coba
rek = RekeningBank("Budi", 1000000)
rek.setor(500000)
rek.tarik(200000)
print(f"Pemilik : {rek.get_pemilik()}")
print(f"Saldo   : Rp{rek.get_saldo():,}")
PYTHON,
                'narasi_tahap' => [
                    ['langkah' => 1, 'narasi' => 'Class RekeningBank dibuat dengan atribut __pemilik dan __saldo yang bersifat private (ditandai double underscore).'],
                    ['langkah' => 2, 'narasi' => 'Method get_pemilik() dan get_saldo() adalah getter untuk mengakses data private dari luar class.'],
                    ['langkah' => 3, 'narasi' => 'Method setor() menambah saldo hanya jika jumlah > 0, menjaga validitas data.'],
                    ['langkah' => 4, 'narasi' => 'Method tarik() memeriksa kecukupan saldo sebelum mengurangi, mencegah saldo negatif.'],
                    ['langkah' => 5, 'narasi' => 'Objek rek dibuat lalu setor 500.000 dan tarik 200.000. Output menampilkan info pemilik dan saldo akhir.', 'output' => "Setor Rp500,000 berhasil. Saldo: Rp1,500,000\nTarik Rp200,000 berhasil. Saldo: Rp1,300,000\nPemilik : Budi\nSaldo   : Rp1,300,000"],
                ],
            ],
            [
                'judul'      => 'Inheritance: Hewan & Anjing',
                'deskripsi'  => 'Pelajari konsep pewarisan dengan class Anjing yang mewarisi atribut dan method dari parent class Hewan menggunakan super().',
                'materi'     => 'inheritance',
                'urutan'     => 2,
                'aktif'      => true,
                'kode_python' => <<<'PYTHON'
class Hewan:
    def __init__(self, nama, suara):
        self.nama = nama
        self.suara = suara

    def bersuara(self):
        print(f"{self.nama} berkata: {self.suara}!")

    def info(self):
        print(f"Hewan: {self.nama}")

class Anjing(Hewan):
    def __init__(self, nama):
        super().__init__(nama, "Guk Guk")
        self.jenis = "Mamalia"

    def fetch(self, barang):
        print(f"{self.nama} mengambil {barang}!")

# Uji coba
h = Hewan("Kucing", "Meow")
h.bersuara()

a = Anjing("Rex")
a.info()
a.bersuara()
a.fetch("bola")
PYTHON,
                'narasi_tahap' => [
                    ['langkah' => 1, 'narasi' => 'Class Hewan adalah parent class dengan atribut nama dan suara, serta method bersuara() dan info().'],
                    ['langkah' => 2, 'narasi' => 'Class Anjing mewarisi Hewan. super().__init__() memanggil constructor parent untuk inisialisasi nama dan suara.'],
                    ['langkah' => 3, 'narasi' => 'Anjing menambah atribut jenis dan method fetch() yang tidak ada di parent class.'],
                    ['langkah' => 4, 'narasi' => 'Objek Anjing dapat menggunakan method info() dan bersuara() yang diwarisi dari Hewan.', 'output' => "Kucing berkata: Meow!\nHewan: Rex\nRex berkata: Guk Guk!\nRex mengambil bola!"],
                ],
            ],
            [
                'judul'      => 'Enkapsulasi & Inheritance: Kendaraan',
                'deskripsi'  => 'Gabungkan enkapsulasi dan inheritance. Class Motor mewarisi Kendaraan sambil melindungi data kecepatan dengan atribut private.',
                'materi'     => 'keduanya',
                'urutan'     => 3,
                'aktif'      => true,
                'kode_python' => <<<'PYTHON'
class Kendaraan:
    def __init__(self, merek, kecepatan_max):
        self.merek = merek
        self.__kecepatan_max = kecepatan_max   # private

    def get_kecepatan_max(self):
        return self.__kecepatan_max

    def info(self):
        print(f"{self.merek} | Maks: {self.__kecepatan_max} km/h")

class Motor(Kendaraan):
    def __init__(self, merek, kecepatan_max, jenis):
        super().__init__(merek, kecepatan_max)
        self.jenis = jenis

    def info(self):
        super().info()
        print(f"Tipe: {self.jenis}")

    def bergerak(self):
        print(f"{self.merek} melaju dengan kecepatan maks {self.get_kecepatan_max()} km/h!")

# Uji coba
k = Kendaraan("Toyota", 200)
k.info()

m = Motor("Honda", 180, "Sport")
m.info()
m.bergerak()
PYTHON,
                'narasi_tahap' => [
                    ['langkah' => 1, 'narasi' => 'Kendaraan menyimpan __kecepatan_max sebagai private — diakses via get_kecepatan_max().'],
                    ['langkah' => 2, 'narasi' => 'Motor mewarisi Kendaraan dan meng-override method info() dengan menambahkan tipe kendaraan.'],
                    ['langkah' => 3, 'narasi' => 'super().info() memanggil info() dari parent sebelum menampilkan info tambahan milik Motor.', 'output' => "Toyota | Maks: 200 km/h\nHonda | Maks: 180 km/h\nTipe: Sport\nHonda melaju dengan kecepatan maks 180 km/h!"],
                ],
            ],
        ];

        foreach ($skenarios as $data) {
            Skenario::updateOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }

        $this->command->info('3 skenario simulasi berhasil dibuat.');
    }
}
