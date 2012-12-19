<h1>User Profile</h1>
<p>You can view and update users profile information.</p>
<?= $edituser_form ?>

<table class="table table-striped table-bordered table-hover">
    <caption><h4>Membership in the group</h4></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acronym</th>
            <th>Join</th>
            <th>Leave</th>
        </tr>    
    </thead>
    <?php if ($groups != null): ?>
        <tbody>
            <?php foreach ($groups as $val): ?>
                <tr>
                    <td><?= $val['id'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['acronym'] ?></td>
                    <td><a href='<?= create_url("acp/join/{$val['id']}/{$userid}") ?>'><i class="icon-plus-sign"></i></a></td>
                    <td>
                        <?php foreach ($usersgroups['groups'] as $group): ?>
                            <?php if ($val['id'] === $group['id']): ?>
                                <a href='<?= create_url("acp/leave/{$val['id']}/{$userid}") ?>'><i class="icon-remove"></i></a>
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
</table>
