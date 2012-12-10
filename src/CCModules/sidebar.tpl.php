<div class='box'>
<h4>Modules</h4>
<p>All Kontur modules.</p>
<ul>
 <? foreach ($modules as $module): ?>
<li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
 <? endforeach; ?>    
</ul>
</div>

<div class='box'>
<h4>Kontur Core</h4>
<p>All Kontur Core modules.</p>
<ul>
 <? foreach ($modules as $module): ?>
    <? if($module['isKonturCore']): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>    
</ul>
</div>

<div class='box'>
<h4>Kontur CMF</h4>
<p>Kontur Content Management Framework (CMF) modules.</p>
<ul>
  <? foreach ($modules as $module): ?>
    <? if($module['isKonturCMF']): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>        
</ul>
</div>

<div class='box'>
<h4>Models</h4>
<p>A class is considered a model if its name starts with CM.</p>
<ul>
  <? foreach ($modules as $module): ?>
    <? if($module['isModel']): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>        
</ul>
</div>

<div class='box'>
<h4>Controllers</h4>
<p>Implements interface <code>IController</code>.</p>
<ul>
  <? foreach ($modules as $module): ?>
    <? if($module['isController']): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>        
</ul>
</div>

<div class='box'>
<h4>Contains SQL</h4>
<p>Implements interface <code>IHasSQL</code>.</p>
<ul>
  <? foreach ($modules as $module): ?>
    <? if($module['hasSQL']): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>
</ul>
</div>

<div class='box'>
<h4>More modules</h4>
<p>Modules that does not implement any specific Kontur interface.</p>
<ul>
  <? foreach ($modules as $module): ?>
    <?php if(!($module['isController'] || $module['isKonturCore'] || $module['isKonturCMF'])): ?>
    <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li>
    <? endif ?>
 <? endforeach; ?>        
</ul>
</div>