<?php
class Service1
{
    public function ambilData()
    {
        $koneksi = new mysqli('localhost', 'root', '', 'perpustakaan');
        $hasil = $koneksi->query("SELECT * FROM buku ");
        while ($rows = $hasil->fetch_array()) {
            $return_brg[] = array(
                'id' => $rows['id'],
                'judul' => $rows['judul'],
                'pengarang' => $rows['pengarang'],
                'penerbit' => $rows['penerbit'],
                'tahun_terbit' => $rows['tahun_terbit'],
                'deskripsi' => $rows['deskripsi'],
            );
        }
        return json_encode($return_brg);
    }
}

$opt = ["uri" => "http://www.server1.com/"];
//membuat kelas instan
$serv = new SoapServer(NULL, $opt);
//memanggil kelas
$serv->setClass('Service1');
//start
$serv->handle();
