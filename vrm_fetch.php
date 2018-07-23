<?php

function writeValueToFile($file, $value, $append = false)
{
    $mode = 'w';
    if ($append === true)
    $mode = 'a';
    $fh = fopen("/var/www/html/status/".$file, $mode);
    flock($fh, LOCK_EX);
    fwrite($fh, $value."\n");
    flock($fh, LOCK_UN);
    fclose($fh);

} 

    $connection = ssh2_connect('192.168.0.5', 22); // Add your Victron system IP address here
    if (ssh2_auth_password($connection, 'root', '')) { // Add your Victron root password here
      $i = 0;
	while ($i < 100) {
	    $i++;
	    $stream = ssh2_exec($connection, "dbus -y com.victronenergy.system / GetValue");
	    stream_set_blocking($stream, true);
	    $output = str_replace('\'', '"', stream_get_contents($stream));
	    $output = str_replace('"AvailableBatteryServices": "{"', '"AvailableBatteryServices": {"', $output);
	    $output = str_replace('"}",', '"},', $output);
#        echo $output;
	    echo "\n";
	    fclose ($stream);
	    $data = json_decode($output);
	    $value_grid = $data->{'Ac/Grid/L1/Power'} + $data->{'Ac/Grid/L2/Power'} + $data->{'Ac/Grid/L3/Power'};
	    $value_consumption = $data->{'Ac/Consumption/L1/Power'} + $data->{'Ac/Consumption/L2/Power'} + $data->{'Ac/Consumption/L3/Power'};
	    $value_pv = $data->{'Ac/PvOnGrid/L1/Power'} + $data->{'Ac/PvOnGrid/L2/Power'} + $data->{'Ac/PvOnGrid/L3/Power'};
	    $value_battery_soc = $data->{'Dc/Battery/Soc'};
	    $value_battery_power = $data->{'Dc/Battery/Power'};
	    $value_actualconsumption = $value_consumption;
	    $value_battery_voltage = $data->{'Dc/Battery/Voltage'};
	    $value_battery_current = $data->{'Dc/Battery/Current'};

	    if ($value_battery_power > 0) {
		$value_actualconsumption = $value_consumption - $value_battery_power;
	    }
// else {
//		$value_actualconsumption = $value_consumption + $value_battery_power;
//	    }

	    $output = '{"time":'.(time()*1000).',
			"Grid": '.$value_grid.',
			"PV": '.$value_pv.',
			"Consumption": '.$value_consumption.',
			"ActualConsumption": '.$value_actualconsumption.',
			"BatterySOC": '.$value_battery_soc.',
			"BatteryVoltage": '.$value_battery_voltage.',
			"BatteryCurrent": '.$value_battery_current.',
			"BatteryPower": '.$value_battery_power.'}';

	    echo $output;

	    if ($value_pv < 0)
	        $value_pv = 0;
	    writeValueToFile("soc.txt", round($value_battery_soc)."\n".round($value_pv/1000,1)."\n".round($value_actualconsumption/1000,1)."\n".round($value_grid/1000,1)."\n".round($value_battery_power/1000,1)."\n".date("H:i")."\n".date("j F Y"));
	    writeValueToFile("pv_w.txt", round($value_pv), true);
	    writeValueToFile("use_w.txt", round($value_actualconsumption), true);
	    writeValueToFile("grid_w.txt", round($value_grid), true);
	    writeValueToFile("battsoc_w.txt", round($value_battery_soc), true);
	    writeValueToFile("battuse_w.txt", round($value_battery_power), true);

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:9200/power/victron');
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($output)));
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$output);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response  = curl_exec($ch);
	    curl_close($ch);
	    echo $response;
	}
		die();
    } else {
	die('Authentication Failed...');
    }