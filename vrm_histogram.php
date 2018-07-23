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

function processHistogram($path, $sourcefile, $histogramfile)
{
    $lastvalues = explode("\n",trim(file_get_contents($path.$sourcefile)));
    writeValueToFile($sourcefile,'');
    $cur = 0;
    for ($i=0; $i<count($lastvalues); $i++)
    {
	if (trim($lastvalues[$i]) !== "")
	    $cur += floatval($lastvalues[$i]);
    }
    $average = $cur / floatval(count($lastvalues));

    writeValueToFile($histogramfile,round($average), true); 
    $lastvalues = explode("\n",trim(file_get_contents($path.$histogramfile)));
    $fp = fopen($path.$histogramfile, 'w');
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
}

processHistogram('/var/www/html/status/', 'pv_w.txt', 'lastpv.txt');
processHistogram('/var/www/html/status/', 'use_w.txt', 'lastuse.txt');
processHistogram('/var/www/html/status/', 'grid_w.txt', 'lastgrid.txt');
processHistogram('/var/www/html/status/', 'battsoc_w.txt', 'lastbattsoc.txt');
processHistogram('/var/www/html/status/', 'battuse_w.txt', 'lastbattuse.txt');

