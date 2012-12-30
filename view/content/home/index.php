		<form action=/><!--man<input type=radio name=type value=man checked>info<input type=radio name=type value=info<?=@$_REQUEST["type"]=="info"?" checked":""?>--><input name=q><input type=submit></form>
		<pre>
<?=htmlspecialchars($data["man"])?>
		</pre>
		<?php foreach($data["pages"]as$cmd):?>
	<a href=/<?=$cmd?>><?=$cmd?></a>
		<?php endforeach;?>
