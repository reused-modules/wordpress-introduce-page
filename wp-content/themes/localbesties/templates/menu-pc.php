<!-- menu pc -->
<nav class="menu-pc">
    <ul class="nav-pc" id="menu-pc">
        <?php
        $menu_items = $args['menu_items'];
        foreach ($menu_items as $menu_item) {
            ?>
            <li class="nav-first <?= $menu_item['childs'] ? 'has-child' : ''; ?>">
                <a class="nav-link" href="<?= $menu_item['item']->url ?>"><?= $menu_item['item']->title ?></a>
                <?php if ($menu_item['childs']) { ?>
                    <ul class="dropdown-child">
                        <?php
                        foreach ($menu_item['childs'] as $child) {
                            ?>
                            <li><a href="<?= $child['item']->url ?>"><?= $child['item']->title ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                <?php } ?>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
<!-- /menu pc -->