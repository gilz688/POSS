<?php
$presenter = new Illuminate\Pagination\AjaxBootstrapPresenter($paginator,'retrieve');
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="pagination">
        <?php echo $presenter->render(); ?>
    </ul>
<?php endif; ?>