<div class="row pdocrud-filters-container" data-objkey="<?php echo $objKey; ?>">
    <div class="col-md-12">
        <?php if (isset($filters) && count($filters)) { ?>
            <div class="pdocrud-filters-options">
                <div class="pdocrud-filter-selected mb-3 text-center">
                    <span class="pdocrud-filter-option-remove btn btn-success"><i class="fas fa-broom"></i> <?php echo $lang["clear_all"] ?></span>
                </div>
                <?php
                foreach ($filters as $filter) {
                    echo $filter;
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="col-md-12">
        <?php echo $data ?>
    </div>
</div>