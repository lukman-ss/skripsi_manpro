<?php $pager->setSurroundCount(5) ?>
    
    <div class="dataTables_paginate paging_simple_numbers d-flex flex-row-reverse" id="example2_paginate">
        <ul class="pagination">
            <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="paginate_button page-item active"' : 'class="paginate_button page-item"' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
            <?php endforeach ?>
        </ul>
    </div>