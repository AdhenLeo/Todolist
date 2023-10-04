<div class="container">
    <div class="alerts">
        <?php if (Flasher::has("msg_success")) : ?>
            <div class="alert alert-success">
                <p><?= Flasher::get("msg_success") ?></p>
            </div>
        <?php endif ?>

        <?php if (Flasher::has("msg_error")) : ?>
            <div class="alert alert-danger">
                <p><?= Flasher::get("msg_error") ?></p>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="list-table">
                <div class="card-listtable">
                    <div class="body-list">
                        <div class="card-list-flex">
                        <h4 class="card-title">Main Table</h4>
                        </div>
                        <div class="body-table">
                            <table class="table">
                                <thead>
                                    <tr class="th-color">
                                        <th>Nama Perusahaan</th>
                                        <th>Nama Layanan</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Pemimpin</th>
                                        <!-- <th>Keterangan</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['project'] as $row): ?>
                                <tr>
                                    <td><?= $row['nama_perusahaan'] ?></td>
                                    <td><?= $row['kode_layanan'] ?></td>
                                    <td><?= $row['tanggal_awal'] ?></td>
                                    <td><?= $row['tanggal_akhir'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <!-- <td><span class="ket <?= $row['keterangan'] == "Selesai" ? 'success-badge outline-success' : 'warning-badge outline-warning'?>"><?= $row['keterangan'] ?></span></td> -->
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>