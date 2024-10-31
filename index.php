<? 
echo "hola";


?>

<form enctype="multipart/form-data" action="subida.php" name="form" method="post">
    Seleccione Archivo
        <input type="file" name="file" id="file" /></td>
        <input type="submit" name="submit" id="submit" value="Subir" />
</form>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
        <thead>
            <tr>
                <th width="90%" align="center">Archivos</th>
                <th align="center">Accion</th>	
            </tr>
        </thead>
        <?php
        $conn=new PDO('mysql:host=localhost; dbname=senecalib;port=3307', 'root', '') or die(mysql_error());

        $query=$conn->query("select * from upload order by id desc");
        while($row=$query->fetch()){
            $name=$row['name'];
        ?>
        <tr>
        
            <td>
                &nbsp;<?php echo $name ;?>
            </td>
            <td>
                <button class="alert-success"><a href="download.php?filename=<?php echo $name;?>&f=<?php echo $row['fname'] ?>">Descargar</a></button>
            </td>
        </tr>
        <?php }?>
    </table>
