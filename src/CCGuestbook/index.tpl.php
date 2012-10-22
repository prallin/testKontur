<h1>Gästbok</h1>
<p>Visar hur ramverker kontur sparar till databas</p>


<form action="<?=$formAction?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea name='newEntry'></textarea></label>
  </p>
  <p>
    <input type='submit' name='doAdd' value='Posta ett inlägg' />
    <input type='submit' name='doClear' value='Radera alla inlägg' />
    <input type='submit' name='doCreate' value='Skapa databastabell' />
  </p>
</form>

<h2>Current messages</h2>

<?php foreach($entries as $val):?>
<div class="entries">
  <p>At: <?=$val['created']?></p>
  <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>