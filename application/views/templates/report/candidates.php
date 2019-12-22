
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table   >
    <tr style="font-size:9px; border-bottom:0.5px solid black" >
        <td style="width:23% ">No KK</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "> <?= $house->no_kk ?> </td>
        <td  border="1" padding="2" style="width:20% " rowspan="2" > </td>
    </tr>
    <tr style="font-size:9px;border-bottom:0.5px solid black" >
        <td style="width:23% ">Kepala Keluarga</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "> <?= $house->chief_name ?></td>
    </tr>
    <tr style="font-size:9px;border-bottom:0.5px solid black" >
        <td style="width:23% ">Bantuan Yang Akan Diberikan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "> <?= $house->type_of_aid ?></td>
    </tr>
</table>
<p style="font-size:9px;text-align: center" >
    Kondisi Rumah
</p>

<table >
    <!-- <thead  style="font-size:16px" > -->
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black" bgcolor="rgb(168, 173, 170)" >
        <td style="width:33% ">Status Tanah</td>
        <td style="width:33% "> Sumber Air</td>
        <td style="width:33% "> Sumber Penerangan </td>
    </tr>
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black"  >
        <td style="width:33% "> <?= $house->land_status ?> </td>
        <td style="width:33% "> <?= $house->water_source ?> </td>
        <td style="width:33% "> <?= $house->light_source ?> </td>
    </tr>
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black " bgcolor="rgb(168, 173, 170)" >
        <td style="width:33% ">Material Lantai Terluas</td>
        <td style="width:33% "> Material Dinding Terluas</td>
        <td style="width:33% "> Material Atap Terluas </td>
    </tr>
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black" >
        <td style="width:33% "> <?= $house->floor_material ?> </td>
        <td style="width:33% "> <?= $house->wall_material ?> </td>
        <td style="width:33% "> <?= $house->roof_material ?> </td>
    </tr>
    <!-- </thead> -->
</table>
<!-- <table >
    <?php
        // $images = explode(";", $house->images);
        // $curl_handle=curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, base_url()."uploads/house/".$images[0] );
        // //curl_setopt($curl_handle, CURLOPT_URL, "./uploads/house/".$images[0] );
        // curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        // $images[0] = base64_encode( curl_exec($curl_handle) );
        // curl_close($curl_handle);	
        
        // $curl_handle=curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, base_url()."uploads/house/".$images[1] );
        // curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        // $images[1] = base64_encode( curl_exec($curl_handle) );
        // curl_close($curl_handle);

        // $curl_handle=curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, base_url()."uploads/house/".$images[3] );
        // curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        // $images[3] = base64_encode( curl_exec($curl_handle) );
        // curl_close($curl_handle);	
    ?>
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black" >
        <td style="width:33%; height:33% "><img  src="data:image/gif;base64,<?= $images[0]?>" alt="" height="120" width="auto"></td>
        <td style="width:33%; height:33% "><img  src="data:image/gif;base64,<?= $images[1]?>" alt="" height="120" width="auto"></td>
        <td style="width:33%; height:33% "><img  src="data:image/gif;base64,<?= $images[3]?>" alt="" height="120" width="auto"></td>
    </tr>
    <tr style="font-size:9px;text-align: center;  border-bottom:0.5px solid black "  >
        <td style="width:33% ">Depan</td>
        <td style="width:33% "> Samping</td>
        <td style="width:33% "> Belakang </td>
    </tr>
</table> -->
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->