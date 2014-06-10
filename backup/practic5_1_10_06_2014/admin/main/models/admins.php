<?php if (in_array(getFromGet('action'), $action)): ?>
  <table>
    <?php  foreach ($allUserData as $UserData): ?>
      <tr>
        <td><?php echo $UserData['admin'] ?></td>

        <?php if (getFromGet('action') == 'edit'): ?> 
          <?php if (permission(modelRights('admins', getFromGet('action')), $userRights)): ?>
            <td>Редактировать</td>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (getFromGet('action') == 'delete'): ?> 
          <?php if (permission(modelRights('admins', getFromGet('action')), $userRights)): ?> 
            <td>Удалить</td>
          <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </tr>
   <?php endif; ?> 
  </table>
<a href="<?php echo getUrl('index.php') ?>">Вернуться к списку действий</a>

