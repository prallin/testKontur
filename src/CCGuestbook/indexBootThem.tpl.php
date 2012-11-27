<h2>Gästbok</h2>
<p>Visar hur ramverker kontur sparar till databas</p>
<form action="<?=$formAction?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea rows="3" name='newEntry' placeholder="Skriv något snällt…" class="span4""></textarea></label>      
  </p>
  <p>
    
    <button type='submit' name='doAdd' class='btn btn-success'><i class="icon-pencil icon-white"></i> Posta ett inlägg</button>
    <button type='submit' name='doClear' class='btn btn-danger'><i class="icon-trash icon-white"></i> Radera alla inlägg</button>
    <button type='submit' name='doCreate' class='btn btn-info'><i class="icon-wrench icon-white"></i> Skapa databastabell</button>    
  </p>
</form>

<h3>Current messages</h3>

<?php foreach($entries as $val):?>
<div class="messages">
    <p><small>At: <?=$val['created']?></small></p>
    <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>
