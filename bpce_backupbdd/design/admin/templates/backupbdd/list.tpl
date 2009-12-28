<div class="context-block"><div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h1 class="context-title">{$title}</h1>
<div class="header-mainline"></div>
</div></div></div>
</div></div></div>
<div class="box-ml"><div class="box-mr"><div class="box-content">
<table class="list" cellspacing="0" >
	<tr>
		<th></th>
        <th>{'Date'|i18n( 'backupbdd')}</th>
		<th>{'List DB'|i18n( 'backupbdd')}</th>
        <th>{'Download'|i18n( 'backupbdd')}</th>
	</tr>
{foreach $listebdd as $index => $bddfile  sequence array('bgdark','bglight') as $style}
    <tr class="{$style}">
		<td><a href={concat("backupbdd/delete/",$listebdd[$index].savebdd_filename_original)|ezurl} target="_blank">X</a></td>
        <td>{$listebdd[$index].savebdd_timestamp|l10n('shortdatetime')}</td>
        <td>{$listebdd[$index].savebdd_name}</td>
        <td><a href={concat("backupbdd/download/",$listebdd[$index].savebdd_filename_original)|ezurl} target="_blank">Download</a></td>
    </tr>
{/foreach}
</table>

</div></div></div>
<div class="controlbar">
<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
</div></div></div></div></div></div>
</div>
</div>