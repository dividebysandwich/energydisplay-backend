<?php

//This is what the source data looks like:
//
//root@beaglebone:~// dbus -y com.victronenergy.system / GetValue
//{'Ac/ActiveIn/Source': 1,
// 'Ac/Consumption/L1/Power': 266.40000000000003,
// 'Ac/Consumption/L2/Power': 321.80000000000001,
// 'Ac/Consumption/L3/Power': 131.30000000000001,
// 'Ac/Consumption/NumberOfPhases': 3,
// 'Ac/ConsumptionOnInput/L1/Power': 266.40000000000003,
// 'Ac/ConsumptionOnInput/L2/Power': 321.80000000000001,
// 'Ac/ConsumptionOnInput/L3/Power': 131.30000000000001,
// 'Ac/ConsumptionOnInput/NumberOfPhases': 3,
// 'Ac/ConsumptionOnOutput/L1/Power': [],
// 'Ac/ConsumptionOnOutput/L2/Power': [],
// 'Ac/ConsumptionOnOutput/L3/Power': [],
// 'Ac/ConsumptionOnOutput/NumberOfPhases': [],
// 'Ac/Genset/DeviceType': [],
// 'Ac/Genset/L1/Power': [],
// 'Ac/Genset/L2/Power': [],
// 'Ac/Genset/L3/Power': [],
// 'Ac/Genset/NumberOfPhases': [],
// 'Ac/Genset/ProductId': [],
// 'Ac/Grid/DeviceType': 345,
// 'Ac/Grid/L1/Power': 292.10000000000002,
// 'Ac/Grid/L2/Power': 351.30000000000001,
// 'Ac/Grid/L3/Power': 135.80000000000001,
// 'Ac/Grid/NumberOfPhases': 3,
// 'Ac/Grid/ProductId': 45069,
// 'Ac/PvOnGenset/L1/Power': [],
// 'Ac/PvOnGenset/L2/Power': [],
// 'Ac/PvOnGenset/L3/Power': [],
// 'Ac/PvOnGenset/NumberOfPhases': [],
// 'Ac/PvOnGrid/L1/Power': -0.70000000000000007,
// 'Ac/PvOnGrid/L2/Power': -0.5,
// 'Ac/PvOnGrid/L3/Power': -6.5,
// 'Ac/PvOnGrid/NumberOfPhases': 3,
// 'Ac/PvOnOutput/L1/Power': [],
// 'Ac/PvOnOutput/L2/Power': [],
// 'Ac/PvOnOutput/L3/Power': [],
// 'Ac/PvOnOutput/NumberOfPhases': [],
// 'ActiveBatteryService': 'com.victronenergy.battery/512',
// 'AutoSelectedBatteryMeasurement': 'com_victronenergy_battery_512/Dc/0',
// 'AutoSelectedBatteryService': [],
// 'AvailableBatteryMeasurements': {'com_victronenergy_battery_512/Dc/0': 'BYD B-Box battery on CAN-bus',
//                                  'com_victronenergy_vebus_261/Dc/0': 'MultiGrid 48/3000/35-50 on VE.Bus',
//                                  'default': 'Automatic',
//                                  'nobattery': 'No battery monitor'},
// 'AvailableBatteryServices': '{"default": "Automatic", "com.victronenergy.vebus/261": "MultiGrid 48/3000/35-50 on VE.Bus", "nobattery": "No battery monitor", "com.victronenergy.battery/512": "BYD B-Box battery on CAN-bus"}',
// 'Buzzer/State': 0,
// 'Connected': 1,
// 'Control/BmsParameters': 1,
// 'Control/Dvcc': 1,
// 'Control/ExtraBatteryCurrent': 1,
// 'Control/MaxChargeCurrent': True,
// 'Control/ScheduledCharge': 0,
// 'Control/SolarChargeCurrent': 0,
// 'Control/SolarChargeVoltage': 0,
// 'Control/SolarChargerTemperatureSense': 1,
// 'Control/SolarChargerVoltageSense': 0,
// 'Control/VebusSoc': 1,
// 'Dc/Battery/Alarms/CircuitBreakerTripped': [],
// 'Dc/Battery/ConsumedAmphours': [],
// 'Dc/Battery/Current': 0.0,
// 'Dc/Battery/Power': 0,
// 'Dc/Battery/Soc': 10,
// 'Dc/Battery/State': 0,
// 'Dc/Battery/Temperature': 21.0,
// 'Dc/Battery/TemperatureService': 'com.victronenergy.battery.socketcan_can1',
// 'Dc/Battery/TimeToGo': [],
// 'Dc/Battery/Voltage': 51.509998321533203,
// 'Dc/Battery/VoltageService': 'com.victronenergy.battery.socketcan_can1',
// 'Dc/Charger/Power': [],
// 'Dc/Pv/Current': [],
// 'Dc/Pv/Power': [],
// 'Dc/System/Power': [],
// 'Dc/Vebus/Current': 0.0,
// 'Dc/Vebus/Power': 28,
// 'Debug/BatteryOperationalLimits/CurrentOffset': 0,
// 'Debug/BatteryOperationalLimits/SolarVoltageOffset': 0,
// 'Debug/BatteryOperationalLimits/VebusVoltageOffset': 0,
// 'DeviceInstance': 0,
// 'FirmwareVersion': [],
// 'HardwareVersion': [],
// 'Hub': 4,
// 'Mgmt/Connection': 'data from other dbus processes',
// 'Mgmt/ProcessName': '/opt/victronenergy/dbus-systemcalc-py/dbus_systemcalc.py',
// 'Mgmt/ProcessVersion': '1.73',
// 'ProductId': [],
// 'ProductName': [],
// 'PvInvertersProductIds': [45069],
// 'Relay/0/State': 0,
// 'Relay/1/State': 0,
// 'Serial': '985dad37d3be',
// 'ServiceMapping/com_victronenergy_battery_512': 'com.victronenergy.battery.socketcan_can1',
// 'ServiceMapping/com_victronenergy_grid_32': 'com.victronenergy.grid.cgwacs_ttyUSB0_di32_mb1',
// 'ServiceMapping/com_victronenergy_hub4_0': 'com.victronenergy.hub4',
// 'ServiceMapping/com_victronenergy_pvinverter_30': 'com.victronenergy.pvinverter.cgwacs_ttyUSB1_di30_mb1',
// 'ServiceMapping/com_victronenergy_settings_0': 'com.victronenergy.settings',
// 'ServiceMapping/com_victronenergy_vebus_261': 'com.victronenergy.vebus.ttyO5',
// 'SystemState/BatteryLife': 0,
// 'SystemState/ChargeDisabled': 0,
// 'SystemState/DischargeDisabled': 0,
// 'SystemState/LowSoc': 1,
// 'SystemState/SlowCharge': 0,
// 'SystemState/State': 3,
// 'SystemState/UserChargeLimited': 0,
// 'SystemState/UserDischargeLimited': 0,
// 'SystemType': 'ESS',
// 'VebusService': 'com.victronenergy.vebus.ttyO5'}


//dbus -y com.victronenergy.grid.cgwacs_ttyUSB0_di32_mb1 / GetValue
//value = {'Ac/Current': 4.0170000000000003,
// 'Ac/Energy/Forward': 5604.9000000000005,
// 'Ac/Energy/Reverse': 5318.5,
// 'Ac/L1/Current': 1.282,
// 'Ac/L1/Energy/Forward': 1487.3000000000002,
// 'Ac/L1/Energy/Reverse': 1972.9000000000001,
// 'Ac/L1/Power': 292.69999999999999,
// 'Ac/L1/Voltage': 233.10000000000002,
// 'Ac/L2/Current': 1.3540000000000001,
// 'Ac/L2/Energy/Forward': 2138.2000000000003,
// 'Ac/L2/Energy/Reverse': 1662.4000000000001,
// 'Ac/L2/Power': 229.80000000000001,
// 'Ac/L2/Voltage': 233.10000000000002,
// 'Ac/L3/Current': 1.381,
// 'Ac/L3/Energy/Forward': 1936.3000000000002,
// 'Ac/L3/Energy/Reverse': 1663.7,
// 'Ac/L3/Power': 247.10000000000002,
// 'Ac/L3/Voltage': 233.10000000000002,
// 'Ac/Power': 769.70000000000005,
// 'Ac/Voltage': 233.10000000000002,
// 'Connected': 1,
// 'CustomName': '',
// 'DeviceInstance': 32,
// 'DeviceType': 345,
// 'ErrorCode': 0,
// 'FirmwareVersion': 3,
// 'Mgmt/Connection': '/dev/ttyUSB0',
// 'Mgmt/ProcessName': '/opt/victronenergy/dbus-cgwacs/dbus-cgwacs',
// 'Mgmt/ProcessVersion': '1.8.7',
// 'ProductId': 45069,
// 'ProductName': 'Grid meter',
// 'Serial': '106199A'}



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

    $connection = ssh2_connect('192.168.0.5', 22);  // Add your Victron system IP address here
    if (ssh2_auth_password($connection, 'root', '')) { // Add your Victron root password here
      $i = 0;
	  while ($i < 100) {
	    $i++;
	    $stream = ssh2_exec($connection, "nice -n 10 dbus -y com.victronenergy.system / GetValue");
	    stream_set_blocking($stream, true);
	    $output = str_replace('\'', '"', stream_get_contents($stream));
	    $output = str_replace('"AvailableBatteryServices": "{"', '"AvailableBatteryServices": {"', $output);
	    $output = str_replace(': True', ': "TRUE"', $output);
	    $output = str_replace(': False', ': "FALSE"', $output);
	    $output = str_replace('"}",', '"},', $output);

	    fclose ($stream);
	    $data = json_decode($output);
	    $value_grid = $data->{'Ac/Grid/L1/Power'} + $data->{'Ac/Grid/L2/Power'} + $data->{'Ac/Grid/L3/Power'};
            $value_consumption_L1 = $data->{'Ac/Consumption/L1/Power'};
            $value_consumption_L2 = $data->{'Ac/Consumption/L2/Power'};
            $value_consumption_L3 = $data->{'Ac/Consumption/L3/Power'};
	    $value_consumption = $data->{'Ac/Consumption/L1/Power'} + $data->{'Ac/Consumption/L2/Power'} + $data->{'Ac/Consumption/L3/Power'};
	    $value_pv = $data->{'Ac/PvOnGrid/L1/Power'} + $data->{'Ac/PvOnGrid/L2/Power'} + $data->{'Ac/PvOnGrid/L3/Power'};
	    $value_battery_soc = $data->{'Dc/Battery/Soc'};
	    $value_battery_power = $data->{'Dc/Battery/Power'};
	    $value_actualconsumption = $value_consumption;
	    $value_battery_voltage = $data->{'Dc/Battery/Voltage'};
	    $value_battery_current = $data->{'Dc/Battery/Current'};

            $value_efficiency = 100;
            $value_losses = 0;
            if ($value_pv > $value_consumption) {
                $delta = $value_pv - $value_battery_power - $value_consumption;
                if ($delta > 0) {
                    $value_efficiency = 100.0 / $value_pv * ($value_battery_power + $value_consumption);
                    $value_losses = $delta;
                }
            }

	    $stream = ssh2_exec($connection, "nice -n 10 dbus -y com.victronenergy.grid.cgwacs_ttyUSB1_di32_mb1 / GetValue");
	    stream_set_blocking($stream, true);
	    $output = str_replace('\'', '"', stream_get_contents($stream));
	    $output = str_replace('value = ', '', $output);
	    $output = str_replace(': True', ': "TRUE"', $output);
	    $output = str_replace(': False', ': "FALSE"', $output);
	    $output = str_replace('"}",', '"},', $output);

	    fclose ($stream);

	    $data = json_decode($output);
	    $value_grid_volt_L1=$data->{'Ac/L1/Voltage'};
	    $value_grid_volt_L2=$data->{'Ac/L2/Voltage'};
	    $value_grid_volt_L3=$data->{'Ac/L3/Voltage'};

	    $value_grid_power_L1=$data->{'Ac/L1/Power'};
	    $value_grid_power_L2=$data->{'Ac/L2/Power'};
	    $value_grid_power_L3=$data->{'Ac/L3/Power'};

	    $value_grid_forward_L1=$data->{'Ac/L1/Energy/Forward'};
	    $value_grid_forward_L2=$data->{'Ac/L2/Energy/Forward'};
	    $value_grid_forward_L3=$data->{'Ac/L3/Energy/Forward'};

	    $value_grid_reverse_L1=$data->{'Ac/L1/Energy/Reverse'};
	    $value_grid_reverse_L2=$data->{'Ac/L2/Energy/Reverse'};
	    $value_grid_reverse_L3=$data->{'Ac/L3/Energy/Reverse'};

		//Enable this if you have temperature sensors available
	    //$temperature = trim(file_get_contents('/var/www/html/status/temp_i.txt'));
	    //$humidity = trim(file_get_contents('/var/www/html/status/humid_i.txt'));
		//$temperature_outside = trim(file_get_contents('/var/www/html/status/temp_o.txt'));
	    //$humidity_outside = trim(file_get_contents('/var/www/html/status/humid_o.txt'));

	    $output = '{"time":'.(time()*1000).',
			"Grid": '.$value_grid.',
			"PV": '.$value_pv.',
			"Consumption": '.$value_consumption.',
			"Efficiency": '.$value_efficiency.',
			"Losses": '.$value_losses.',
			"ActualConsumption": '.$value_actualconsumption.',
			"BatterySOC": '.$value_battery_soc.',
			"BatteryVoltage": '.$value_battery_voltage.',
			"BatteryCurrent": '.$value_battery_current.',
			"BatteryPower": '.$value_battery_power.',
			"GridVoltL1": '.$value_grid_volt_L1.',
			"GridVoltL2": '.$value_grid_volt_L2.',
			"GridVoltL3": '.$value_grid_volt_L3.',
			"GridPowerL1": '.$value_grid_power_L1.',
			"GridPowerL2": '.$value_grid_power_L2.',
			"GridPowerL3": '.$value_grid_power_L3.',
			"GridConsumptionL1": '.$value_consumption_L1.',
			"GridConsumptionL2": '.$value_consumption_L2.',
			"GridConsumptionL3": '.$value_consumption_L3.',
			"GridForwardL1": '.$value_grid_forward_L1.',
			"GridForwardL2": '.$value_grid_forward_L2.',
			"GridForwardL3": '.$value_grid_forward_L3.',
			"GridReverseL1": '.$value_grid_reverse_L1.',
			"GridReverseL2": '.$value_grid_reverse_L2.',
			"GridReverseL3": '.$value_grid_reverse_L3.'}';
//			"Temperature": '.$temperature.',
//			"Humidity": '.$humidity.',
//			"TemperatureOutside": '.$temperature_outside.',
//			"HumidityOutside": '.$humidity_outside.'}';

	    echo $output;

	    if ($value_pv < 0)
	        $value_pv = 0;
		//Save summary information
	    writeValueToFile("soc.txt", round($value_battery_soc)."\n".round($value_pv/1000,1)."\n".round($value_actualconsumption/1000,1)."\n".round($value_grid/1000,1)."\n".round($value_battery_power/1000,1)."\n".date("H:i")."\n".date("j F Y"));
		//Append histogram data
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
