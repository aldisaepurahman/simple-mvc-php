# simple-mvc-php
Created by : aldisaepurahman (aldisaepurahman@gmail.com)

Simple MVC PHP ini adalah MVC yang dibuat menggunakan PHP native.

- Cara menggunakan

Untuk menggunakannya, hal pertama yang dilakukan adalah membuka file **config.php** pada folder **app/config/config.php**. Disana kalian bisa mengedit base url sesuai dengan nama folder project kalian di localhost atau dengan nama halaman website kalian. Selain itu, atur juga nama database yang akan kalian pakai di file tersebut
> ``define('base_url', 'http://localhost/direktorifolderproject/');``
> 
> ``define('database', 'namadatabase');``

atau:

> ``define('base_url', 'http://namawebsite.com/');``
> 
> ``define('database', 'namadatabase');``

- Ganti default controller

Bila ingin mengganti default controller, silahkan buka file **App.php** pada folder **app/config/App.php** dan ganti variabel controller dengan nama controller yang ingin dijadikan default controller yang baru. Pastikan huruf pertama nama controller yang baru adalah huruf kapital

> ``protected $controller = 'NamaController';``

- Buat controller baru

Untuk membuat controller baru, kalian bisa buat file baru pada folder **controllers** dan beri nama controller tersebut sesuai yang kalian inginkan (dengan catatan huruf pertama nya adalah huruf **kapital**), contoh **Home.php**. Lalu buatlah sintaks seperti berikut:

> ``<?php``
> 
> ``class Home extends Controller``
> 
> ``{``
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``public function __construct() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``...``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``}``
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``public function index() {``
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``$this->view('namaview');``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``}``
>
> ``}``
> ``?>``

- Membawa data ke view

Jika ingin membawa data kedalam view, maka ubah cara pemanggilan view sebagai berikut:

> ``$data['namadata'] = isi data;``
>
> ``$this->view('namaview', $data);``

Isi dari variabel data bisa apapun, mau itu data dari database, string, integer, dan lainnya

- Memanggil model

Jika ingin memanggil model, maka isi method __construct dengan cara berikut:

> ``$this->variabelmodel = $this->model('namamodel');``

Variabel 'variabelmodel' didefinisikan oleh kalian sebagai atribut private dari controller. Jika ingin memanggil method dari model, bisa dilakukan dengan cara berikut:

> ``$simpan = $this->variabelmodel->namamethodModel();``

Penggunaan parameter disesuaikan dengan kebutuhan dari method di model.

- Redirect ke halaman lain

Jika ingin melakukan redirect ke halaman lain, bisa menggunakan sintaks **redirectTo** didalam method yang kalian buat, Sintaks tersebut merupakan bawaan dari Controller utama

> ``$this->redirectTo('/namacontroller/namamethod');``

Jika nama method yang dipanggil adalah index, maka cara pemanggilan bisa disingkat menjadi:

> ``$this->redirectTo('/namacontroller');``

Jika ingin kembali ke halaman awal ketika membuka halaman web (atau dengan kata lain kembali ke method index controller default), cukup gunakan:

> ``$this->redirectTo('/');``

- Membuat model baru

Jika ingin membuat model baru, kalian bisa buat file baru pada folder **models** dan beri nama model tersebut sesuai dengan yang kalian inginkan, (dengan catatan huruf pertama nya adalah huruf **kapital**), contoh **Mahasiswa.php**. Lalu buatlah sintaks seperti berikut:

> ``<?php``
> 
> ``class Mahasiswa extends Model``
> 
> ``{``
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; protected $requiredFields = [];
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; protected $primaryKey = 'namaprimarykeytable';
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; protected $table = 'namatable';
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``public function __construct() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``parent::__construct();``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``}``
>
> ``}``
> 
> ``?>``

Bisa dilihat pada sintaks diatas ada variabel requiredFields. Variabel tersebut bisa diisi dengan nama-nama atribut dalam tabel tersebut, termasuk primary key nya.

- Membuat method insert data

Sintaks yang digunakan untuk insert data sebagai berikut:

> ``public function namafunction($parameters1) {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->insert($parameters1);``
> 
> ``}`

Sintaks diatas akan membentuk query **INSERT INTO 'namatable' VALUES (data dari parameters1)**. Variabel parameters1 adalah data yang akan diinsert.

- Membuat method update data

Sintaks yang digunakan untuk update data sebagai berikut:

> ``public function namafunction($parameters1, $parameters2) {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->update($parameters1, ['atributtabel' => $parameters2]);``
> 
> ``}`

Sintaks diatas akan membentuk query **UPDATE 'namatable' SET atribut yang diganti pada parameters1 WHERE atributtabel = parameters2**. Variabel parameters1 adalah data yang akan diupdate dan parameters2 adalah data mana yang akan diupdate berdasarkan atribut tabel (biasanya berdasarkan primary key table).

- Membuat method delete data

Sintaks yang digunakan untuk delete data sebagai berikut:

> ``public function namafunction($parameters1) {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->delete(['atributtabel' => $parameters1]);``
> 
> ``}`

Sintaks diatas akan membentuk query **DELETE 'namatable' WHERE atributtabel = parameters1**. Variabel parameters1 adalah data mana yang akan didelete berdasarkan atribut tabel (biasanya berdasarkan primary key table).

- Membuat method select data

Sintaks yang digunakan untuk select data sebagai berikut:

> ``public function namafunction() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->get()->asObject();``
> 
> ``}`

Sintaks diatas akan membentuk query **SELECT atribut yang dipanggil FROM namatable** dan datanya akan direturn sebagai object. Jika ingin data yang dipanggil direturn sebagai array data, maka ganti clausa asObject() dengan asArray() sebagai berikut:

> ``public function namafunction() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->get()->asArray();``
> 
> ``}`

- Select data menggunakan klausa where

Jika ingin menambahkan klausa where, caranya adalah sebagai berikut:

> ``public function namafunction($parameters) {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->where(['atributtabel' => $parameters])->get()->asObject();``
> 
> ``}`

Sintaks diatas akan membentuk query **SELECT atribut yang dipanggil FROM namatable WHERE atributtabel = parameters**

- Select data menggunakan klausa group by

Jika ingin menambahkan klausa group by, caranya adalah sebagai berikut:

> ``public function namafunction() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->groupBy('atributtabel')->get()->asObject();``
> 
> ``}`

Sintaks diatas akan membentuk query **SELECT atribut yang dipanggil FROM namatable GROUP BY atributtabel**

- Select data menggunakan klausa order by

Jika ingin menambahkan klausa order by, caranya adalah sebagai berikut:

> ``public function namafunction() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->orderBy('atributtabel')->get()->asObject();``
> 
> ``}`

Sintaks diatas akan membentuk query **SELECT atribut yang dipanggil FROM namatable ORDER BY atributtabel**. Jika ingin sorting secara descending, maka tambahkan klausa 'DESC' pada pemanggilan method orderBy

> ``public function namafunction() {``
> 
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ``return $this->db->table($this->table)->select("atribut yang dipanggil")->orderBy('atributtabel', 'DESC')->get()->asObject();``
> 
> ``}`

Penggunaan parameter disesuaikan dengan kebutuhan method, dan nama function serta nama variabel parameter pula disesuaikan dengan keinginan kalian.
