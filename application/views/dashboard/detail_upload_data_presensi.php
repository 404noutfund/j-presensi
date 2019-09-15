<div class="panel panel-orange mb-35">
    <div class="panel-heading">
        <h5 id="judul"><i class="fa fa-table"></i> Upload Data Log Mesin, ID <?= $id.' <b>'.$device_data[0]['device_name'].'</b>'; ?></h5>
        <div class="pull-right" id="btn-panel">
            <a href="<?= base_url('upload/'); ?>" class="btn btn-md btn-danger">Tabel Data</a>
        </div>
    </div>
    <table class="table" width="100%">
        <thead>
            <th width="25%">Kolom</th>
            <th>Hasil</th>
        </thead>
        <tbody>
            <tr class="{cycle values='odd,even'}">
                <td>Device ID Otomatis:</td>
                <td><?= $device_data[0]['devid_auto']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Alamat IP:</td>
                <td><?= $device_data[0]['ip_address']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Nama Device:</td>
                <td><?= $device_data[0]['device_name']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>SN:</td>
                <td><?= $device_data[0]['sn']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Ethernet Port:</td>
                <td><?= $device_data[0]['ethernet_port']; ?></td>
            </tr><tr class="{cycle values='odd,even'}">
                <td>Upload File Log Presensi</td>
                <form action="" method="post" enctype="multipart/form-data">
                    <td>
                        Download File Log Presensi dari mesin menggunakan Flashdisk.<br>
                        Masuk sebagai Admin di mesin presensi, menu Mgmt->Download<br>
                        Upload file 1_attlog.dat terdapat di flashdisk setelah melakukan download, melalui form ini.<br><br>
                        <div class="d-ib">
                            <input type="file" name="userfile" multiple="multiple"  />
                        </div>
                        <div class="d-ib">
                            <input type="submit" name="submit" value="Upload" class="btn btn-success btn-md" />
                        </div>
                    </td>
                </form>
                <?php 
                    if(isset($upload_data)){
                        foreach($upload_data as $name => $value){
                            echo $name.':'.$value;
                            echo "<br>";
                        }
                    }
                    if(isset($messages)){
                        echo $messages;
                    }
                ?>
            </tr>
        </tbody>
    </table>
</div>
<div class="panel panel-orange">
    <div class="panel-heading">
        <h5 id="judul"><i class="fa fa-table"></i> HISTORI UPLOAD DATA LOG PER TANGGAL <?= date("d-m-Y"); ?></h5>
    </div>
    <table class="table" width="100%">
        <thead>
            <tr>                
                <th width="20px;">NO</th>
                <th width="120px;">FILE</th>
                <th width="200px;">ID MESIN</th>
                <th width="200px;">SERIAL NUMBER</th>
                <th width="250px;">WAKTU UPLOAD </th>
                <th width="250px;">UKURAN FILE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($uploaded_files)){
                    $counter = 1;
                    foreach ($uploaded_files as $idx => $rows){ 
                        if(isset($rows)){ ?>
                            <tr>
                                <td><?= $counter++; ?></td>
                                <?php
                                foreach($uploaded_files as $name => $value){ ?>
                                <td><?= $value; ?></td>
                                <?php } ?>
                            </tr>
                        <?php }
                    }
                }
            ?>
        </tbody>
    </table>
</div>