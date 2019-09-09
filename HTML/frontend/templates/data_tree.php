<?php
    require_once("../../config/db_con.php");
    myOpenDb();
    $results_parent = array();
    $results_area = array();
    $query = "SELECT * FROM mon_area where aktif='1' order by id asc";
    $hasil = myQueryDb($query);
    $i=1;
    while ($data = myFetchDb($hasil))
    {
        $str="select nama,alamat,unit_id,kode_area from mon_bts where kode_area='$data[id]'";
        $res=myQueryDb($str);
        $num=myNumDb($res);
        if($num>0)
        {
            while($row=myFetchDb($res))
            {
                $bts="SELECT waktu FROM log WHERE site_id='".$row['nama']."' ORDER BY waktu DESC LIMIT 0,1";
                $res_str=myQueryDb($bts);
                $row_str=myFetchDb($res_str);
                $to_time = strtotime(date("Y-m-d H:i:s"));
                $from_time = strtotime($row_str['waktu']);
                $diff =round(abs($to_time - $from_time) / 60,2);
                if($diff > 1440)
                {
                    $stat="../../images/red_tower.png"; 
                }
                else
                {
                    $stat="../../images/blue_tower.png";
                }
                
                 $results_area[] = array(
                'id'=>$row['nama'],
                'parent'=>$row['kode_area'],
                'text'=>$row['alamat'],
                'type'=>'child'
                );
            }
        }
        if ($row['kode_area']==null)
        {
            $parent = "#";    
        }
        
        $results_parent[] = array(
                'id'=>$data['id'],
                'parent'=>$parent,
                'text'=>$data['area'],
                'type'=>'root'
                );
        
       
        $i++;
    }
    
    $result = array_merge($results_parent,$results_area);
    //print_r ($result);
    $res_json = json_encode($result);
    $final_str = substr($res_json, 1);
    $final_str_json = substr($final_str, 0,-1);
    //echo $final_str_json;

?>