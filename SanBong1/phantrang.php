<html>
    <head>
        <title>Tạo phân trang</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            
            a {
                text-decoration: none;
            }
            #pagination{
                text-align: center;
                margin-top: 15px;
                
            }
            .page-item{
                border: 1px solid #ccc;
                padding: 5px 9px;
                color: yellow;
                
            }
            .current-page{
                background: #000;
                color: #FFF;
            }
        </style>
    </head>
    <body>
        <div id="pagination">
            <?php
            include 'config.php';
            if (isset($_GET['page'])) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            }
            if (isset($_GET['timkiem'])) {
                $timkiem = $_GET['timkiem'];
            } else {
                $timkiem = "";
            }
            
            $totalRecords = mysqli_query($conn, "SELECT COUNT(*) FROM `sanbong` WHERE TenSan LIKE '%$timkiem%' OR LoaiSan LIKE '%$timkiem%'");
            $totalRecords = $totalRecords->fetch_row()[0];
            $totalPages = ceil($totalRecords / $item_per_page);

            if ($current_page > 3) {
                $first_page = 1;
                ?>
                <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>&timkiem=<?= $timkiem ?>">First</a>
                <?php
            }
            if ($current_page > 1) {
                $prev_page = $current_page - 1;
                ?>
                <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>&timkiem=<?= $timkiem ?>">Prev</a>
            <?php }
            ?>
            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                <?php if ($num != $current_page) { ?>
                    <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>&timkiem=<?= $timkiem ?>"><?= $num ?></a>
                    <?php } ?>
                <?php } else { ?>
                    <strong class="current-page page-item"><?= $num ?></strong>
                <?php } ?>
            <?php } ?>
            <?php
            if ($current_page < $totalPages - 1) {
                $next_page = $current_page + 1;
                ?>
                <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>&timkiem=<?= $timkiem ?>">Next</a>
            <?php
            }
            if ($current_page < $totalPages - 3) {
                $end_page = $totalPages;
                ?>
                <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>&timkiem=<?= $timkiem ?>">Last</a>
                <?php
            }
            ?>
        </div>
    </body>
</html>