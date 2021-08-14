<section id="main">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NIM</th>
          <th scope="col">Nama</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php foreach($mhs as $data): ?>
        <tr>
          <th scope="row"><?= $no++ ?></th>
          <td><?= $data->nim ?></td>
          <td><?= $data->nama ?></td>
          <td>
              <a href="<?= base_url.'perkuliahan/edit/'.$data->nim ?>" class="btn btn-warning">Edit</a>
              <a href="<?= base_url.'perkuliahan/delete/'.$data->nim ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
</section>