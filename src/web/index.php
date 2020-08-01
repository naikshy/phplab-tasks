<?php
require_once './functions.php';

$airports = require './airports.php';

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */
const PAGE_ITEMS_COUNT = 5;
// PAGE_PAGINATION_COUNT should be unpaired number
const PAGE_PAGINATION_COUNT = 5;
const PAGE_PAGINATION_OFFSET = (PAGE_PAGINATION_COUNT - 1) / 2;

$page = $_GET['page'];

//check if 'page' is a number, to avoid unexpected behavior of script
if (!is_numeric($page)) {
    http_response_code(404);
    echo "<b>ERROR 404</b>";
    exit();
} else {
    $page = (int) $page;
}

$pagesCount = (int) ceil(count($airports) / PAGE_ITEMS_COUNT);

if ($page > 0) {
    $airports = array_slice($airports, ($page - 1) * PAGE_ITEMS_COUNT, PAGE_ITEMS_COUNT);
}

//decrease number of pagination items to PAGE_PAGINATION_COUNT
if ($page <= PAGE_PAGINATION_OFFSET) {
    $paginationStart = 1; 
    $paginationEnd = PAGE_PAGINATION_COUNT;
} elseif ($page >= $pagesCount - PAGE_PAGINATION_OFFSET) {
    $paginationStart = $pagesCount - PAGE_PAGINATION_COUNT; 
    $paginationEnd = $pagesCount;
} else {
    $paginationStart = $page - PAGE_PAGINATION_OFFSET; 
    $paginationEnd = $page + PAGE_PAGINATION_OFFSET;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="#"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="/" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="#">Name</a></th>
            <th scope="col"><a href="#">Code</a></th>
            <th scope="col"><a href="#">State</a></th>
            <th scope="col"><a href="#">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="#"><?= $airport['state'] ?></a></td>
            <td><?= $airport['city'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page === 1) ? ' disabled' : '' ?>"><a class="page-link" href="/index.php?page=1">First</a></li>
            <li class="page-item <?= ($page === 1) ? ' disabled' : '' ?>">
                <a class="page-link" href="/index.php?page=<?= ($page === 1) ? $page : $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for($i = $paginationStart; $i <= $paginationEnd; $i++):  ?>
            <li class="page-item <?= ($i === $page) ? ' active' : '' ?>">
                <a 
                    class="page-link" 
                    href="/index.php?page=<?= $i ?>"
                >
                <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page === $pagesCount) ? ' disabled' : '' ?>">
                <a class="page-link" href="/index.php?page=<?= ($page === $pagesCount) ? $page : $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item <?= ($page === $pagesCount) ? ' disabled' : '' ?>"><a class="page-link" href="/index.php?page=<?= $pagesCount ?>">Last</a></li>
        </ul>
    </nav>

</main>
</html>
