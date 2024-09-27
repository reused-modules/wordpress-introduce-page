<?php if ($the_query->max_num_pages > 1):
    // Url cho parent
    if ($parent_category_slug == $term->slug) {
        $url_category = get_url_category($parent_category_slug);
    } else { // Url cho child
        $url_category = get_url_category($parent_category_slug, $term->slug);
    }
    ?>
    <div class="box-paging">
        <nav>
            <ul class="pagination">
                <li class="page-item <?php echo $paged == 1 ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="<?php echo $url_category . 'page/1' ?>"><</a>
                </li>
                <?php
                for ($page = 1; $page <= $the_query->max_num_pages; $page++):
                    $url_page = $url_category . 'page/' . $page;
                    ?>
                    <li class="page-item <?php echo $page == $paged ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo $url_page ?>"><?php echo $page ?></a>
                    </li>
                <?php
                endfor;
                ?>
                <li class="page-item <?php echo $paged == $the_query->max_num_pages ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="<?php echo $url_category . 'page/' . $the_query->max_num_pages ?>">></a>
                </li>
            </ul>
        </nav>
    </div>
<?php endif; ?>