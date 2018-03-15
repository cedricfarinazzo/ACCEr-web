<?php
function is_maintenance() {
    if (file_exists(WEB_PATH.'/data/maintenance.tmp')) {
        if ($handle = fopen(WEB_PATH.'/data/maintenance.tmp','r+')) {
            $data = fgets($handle);
            $data = explode(';', $data);
            $time = $data[0];
            if ($time > time()) {
                fclose($handle);
                return true;
            }
            fclose($handle);
            return false;
        }
        return false;
    }
    return false;
}

function getMaintenanceData() {
    if (is_maintenance()) {
        if ($handle = fopen(WEB_PATH.'/data/maintenance.tmp','r+')) {
            $data = fgets($handle);
            $data = explode(';', $data);
            fclose($handle);
            return $data;
        }
        return false;
    }
    return false;
}

function DeleteMaintenance($pass) {
    $data = getMaintenanceData();
    if (is_array($data)) {
        if ((int)$data[2] == (int)$pass) {
            return @unlink(WEB_PATH.'/data/maintenance.tmp');
        }
        return false;
    }
    return false;
}

function StartMaintenance($tps) {
	if ($handle = fopen(WEB_PATH.'/data/maintenance.tmp','w+'))
	{
		$i = 0;
		$chaine = 0;
		while($i < 6) { 
			$nb = mt_rand(0, 9); 
			$chaine .= $nb; 
			$i++; 
		}
		$tps = time() + $tps*60;
		$token = sha1($chaine.$tps);
		setcookie('_admin_maj',$token ,$tps, '/', null, false, true);
		fseek($handle,0);
		fputs($handle, $tps.';'.$token.';'.$chaine);
		fclose($handle);
		return $chaine;
	}
	return false;
}