<!-- menu sp -->
<nav class="menu-sp">
    <a class="btn-menu-sp-close" href="#"></a>
    <ul id="menu-sp">
        <?php
            $menu_items = $args['menu_items'];
            foreach ($menu_items as $menu_item) {
                ?>
                <li class="nav-first <?= $menu_item['childs'] ? 'has-child' : ''; ?>">
                    <a class="nav-link" href="<?= $menu_item['item']->url ?>">
                        <?= $menu_item['item']->title ?>
                        <?php if ($menu_item['childs']) { ?> <span class="nav-down"></span> <?php } ?>
                    </a>
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

    <div class="box-language-sp">
        <select name="language">
            <option value="en">English</option>
            <option value="vi">Vietnam</option>
        </select>
    </div>
</nav>
<!-- /menu sp -->