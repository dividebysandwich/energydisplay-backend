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

    $lastvalues = explode("\n",trim(file_get_contents('/var/www/html/status/pv_w.txt')));
    writeValueToFile('pv_w.txt','');
    $cur = 0;
    for ($i=0; $i<count($lastvalues); $i++)
    {
	if (trim($lastvalues[$i]) !== "")
	    $cur += floatval($lastvalues[$i]);
    }
    $average = $cur / floatval(count($lastvalues));

    writeValueToFile('lastpv.txt',round($average), true); 
    $lastvalues = explode("\n",trim(file_get_contents('/var/www/html/status/lastpv.txt')));
    $fp = fopen('/var/www/html/status/lastpv.txt', 'w');
    flock($fp, LOCK_EX);
    $beginindex = count($lastvalues)-(130);
    if ($beginindex < 0) {
	$beginindex = 0;
    }
    for ($i=$beginindex; $i<count($lastvalues); $i++)
    {
        if ($i>=0)
	{
	    $curpv = floatval($lastvalues[$i]);
	    if ($curpv !== '') {
		fwrite($fp, $curpv."\n");
	    }
	}
    } 
    flock($fp, LOCK_UN);
    fclose($fp);


    $lastvalues = explode("\n",trim(file_get_contents('/var/www/html/status/use_w.txt')));
    writeValueToFile('use_w.txt','');
    $cur = 0;
    for ($i=0; $i<count($lastvalues); $i++)
    {
	if (trim($lastvalues[$i]) !== "")
	    $cur += floatval($lastvalues[$i]);
    }
    $average = $cur / floatval(count($lastvalues));

    writeValueToFile('lastuse.txt',round($average), true); 
    $lastvalues = explode("\n",trim(file_get_contents('/var/www/html/status/lastuse.txt')));
    $fp = fopen('/var/www/html/status/lastuse.txt', 'w');
    flock($fp, LOCK_EX);
    $beginindex = count($lastvalues)-(130);
    if ($beginindex < 0) {
	$beginindex = 0;
    }
    for ($i=$beginindex; $i<count($lastvalues); $i++)
    {
        if ($i>=0)
	{
	    $curuse = floatval($lastvalues[$i]);
	    if ($curuse !== '') {
		fwrite($fp, $curuse."\n");
	    }
	}
    } 
    flock($fp, LOCK_UN);
    fclose($fp);
