<form action="<?php echo isset($kategori['id']) ? site_url('/kategori/'.$kategori['id'].'/update') : site_url('/kategori'); ?>" method="POST">
    <table>
        <tr>
            <td>Nama Kategori</td>
            <td>
                <input type="text" name="nama_kategori" value="<?php echo isset($kategori['nama_kategori'])? $kategori['nama_kategori'] : '' ?>">
            </td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>
                <textarea name="deskripsi" ><?php echo isset($kategori['deskripsi'])? $kategori['deskripsi'] : '' ?></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Simpan"> 
            </td>
        </tr>
    </table>
</form>
<hr>
<table border="1" style="width: 100%; border:solid 1px #000">
    <tr>
        <td>NO</td>
        <td>NAMA KATEGORI</td>
        <td>DESKRIPSI</td>
        <td>AKSI</td>
    </tr>
    <?php foreach($kategori_data as $key=>$row){ ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo $row['nama_kategori'] ?></td>
            <td><?php echo $row['deskripsi'] ?></td>
            <td>
                
                <?php echo anchor("/kategori/".$row['id']."/edit","Edit"); ?> | 
                <?php echo anchor("/kategori/".$row['id'],"Delete"); ?>
            </td>
        </tr>
    <?php } ?>
</table>