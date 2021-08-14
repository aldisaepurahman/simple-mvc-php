<section id="main">
    <form method="post" action="<?= base_url.'perkuliahan/insert' ?>">
      <div class="form-group">
        <label for="exampleInputEmail1">NIM</label>
        <input type="text" class="form-control" name="nim" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" class="form-control" name="nama" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">No. Telepon</label>
        <input type="text" class="form-control" name="telp" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Angkatan</label>
        <input type="text" class="form-control" name="angkatan" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>