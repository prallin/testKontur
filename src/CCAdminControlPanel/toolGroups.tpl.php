<table class="table table-striped table-bordered table-hover">
    <caption><h4>Groups</h4></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acronym</th>
            <th>Created</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>    
    </thead>
    <?php if($group != null):?>
    <tbody>
        <?php foreach($group as $val):?>
        <tr>
            <td><?=$val['id']?></td>
            <td><?=$val['name']?></td>
            <td><?=$val['acronym']?></td>
            <td><?=$val['created']?></td>       
            <td><a href='<?=create_url("acp/editgroup/{$val['id']}")?>'><i class="icon-edit"></i></a></td>
            <td><a href='<?=create_url("acp/deletegroup/{$val['id']}")?>'><i class="icon-remove"></i></a></td>
            
        </tr>
        <?php endforeach; ?>        
    </tbody>
<?php else:?>
     <tbody>  
        <tr>
            <td>No Group exists.</td>
        </tr>
      </tbody>
<?php endif;?>
    
    <caption align="bottom"><a href='<?=create_url("acp/creategroup")?>'><i class="icon-plus-sign"></i> Add Group</a></caption>
</table>