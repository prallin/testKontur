<?php if($content['created']): ?>
  <h1>Edit Content</h1>
  <p>You can edit and save this content.</p>
<?php else: ?>
  <h1>Create Content</h1>
  <p>Create new content.</p>
<?php endif; ?>


<?=$form->GetHTML(array('class'=>'content-edit'))?>

<p class='smaller-text'><em>
<?php if($content['created']): ?>
  This content were created by <?=$content['owner']?> <?=time_diff($content['created'])?> ago.
<?php else: ?>
  Content not yet created.
<?php endif; ?>

<?php if(isset($content['updated'])):?>
  Last updated <?=time_diff($content['updated'])?> ago.
<?php endif; ?>
</em></p>

<p>
    <a href='<?=create_url('content', 'create')?>'>Create new</a>
    <a href='<?=create_url('page', 'view', $content['id'])?>'>View</a>
    <a href='<?=create_url("content")?>'>view all</a>
</p>


<table class="table table-striped table-bordered table-hover">
    <caption><h4>Content is belonging to groups</h4></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acronym</th>
            <th>Join</th>
            <th>Leave</th>
        </tr>    
    </thead>
    
<?php if($content['created']): ?> 
    <?php if ($groups != null): ?>
        <tbody>
            <?php foreach ($groups as $val): ?>
                <tr>
                    <td><?= $val['id'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['acronym'] ?></td>
                    <td><a href='<?= create_url("content/join/{$val['id']}/{$content['id']}") ?>'><i class="icon-plus-sign"></i></a></td>
                    <td>
                        <?php foreach ($contentsgroups['groups'] as $group): ?>
                            <?php if ($val['id'] === $group['id']): ?>
                                <a href='<?= create_url("content/leave/{$val['id']}/{$content['id']}") ?>'><i class="icon-remove"></i></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </tbody>
    <?php else: ?>
        <tbody>  
            <tr>
                <td>No Group exists.</td>
            </tr>
        </tbody>
    <?php endif; ?>
    <?php else: ?>
               <tbody>  
            <tr>
                <td colspan = "5">Content is not created yet.
You can not add this content to any group now. 
Save the contents. Then you can change the group membership</td>
            </tr>
        </tbody>


<?php endif; ?>
</table>

