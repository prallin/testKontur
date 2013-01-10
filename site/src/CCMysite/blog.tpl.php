<h1>Blog</h1>
<p>MY blog-like list of all content with the type "post"<?php if (authenticated()):?>, <a href='<?=create_url("content")?>'>view all content</a>.<?php endif;?></p>

<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h2><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
    <?php if (authenticated()):?>
    <p class='smaller-text silent'><a href='<?=create_url("content/edit/{$val['id']}")?>'>edit</a></p>
    <?php endif;?>
  <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>