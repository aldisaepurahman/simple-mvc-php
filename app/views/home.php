welcome home
<table border=1>
    <thead>
        <th>NIM</th>
        <th>Nama</th>
    </thead>
    <tbody>
        <?php foreach($mhs as $data): ?>
            <tr>
                <td><?= $data->nim ?></td>
                <td><?= $data->nama ?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<br>
<?php echo $title; ?>
<img src="<?= base_url.'/assets/images/618178-math-wallpapers.jpg' ?>" alt="">
<br>