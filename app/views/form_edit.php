<section id="main">
    <?php foreach($mhs as $data): ?>
    <form method="post" action="<?= base_url.'perkuliahan/update/'.$data->nim ?>">
      <div class="form-group">
        <label for="exampleInputEmail1">NIM</label>
        <input type="text" class="form-control" name="nim" value="<?= $data->nim ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?= $data->nama ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">No. Telepon</label>
        <input type="text" class="form-control" name="telp" value="<?= $data->telp ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Angkatan</label>
        <input type="text" class="form-control" name="angkatan" value="<?= $data->angkatan ?>">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php endforeach; ?>
</section>