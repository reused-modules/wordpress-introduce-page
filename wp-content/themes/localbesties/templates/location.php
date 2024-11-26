<div class="box-category-header">
    <div class="container">
        <div class="box-cat">
            <h2>Your Destination </h2>
            <select class="form-select location" name="location">
                <option value="">All</option>
                <?php
                $locations = get_terms(
                    array(
                        'taxonomy' => 'location',
                    )
                );
                foreach ($locations as $location):
                    if ($location->parent != 0):
                        ?>
                        <option value="<?php echo $location->slug; ?>"
                            <?php echo $location->slug == $_GET['location'] ? 'selected' : '' ?>>
                            <?php echo $location->name; ?>
                        </option>
                    <?php
                    endif;
                endforeach;
                ?>
            </select>
        </div>
    </div>
</div>
