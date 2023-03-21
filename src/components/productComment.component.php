<?php

function calculateRelativeTime($timestamp)
{
    $time = strtotime($timestamp);
    $now = time();
    $diff = $now - $time;

    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . ' minutes ago';
    } elseif ($diff < 86400) {
        if (floor($diff / 3600) == 1) {
            // if 1 hour ago
            return floor($diff / 3600) . ' hour ago';
        } else {
            return floor($diff / 3600) . ' hours ago';
        }
    } else {
        return floor($diff / 86400) . ' days ago';
    }
}

function createComment($row)
{
    $id = $row['product_id'];
    $title = $row['review_title'];
    $desc = $row['review_desc'];
    $rating = $row['review_rating'];
    $timestamp = $row['review_timestamp'];
?>
    <div class="flex-col w-full py-4 px-4 mx-auto my-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-600">
        <div class="flex flex-row md-10">
            <img class="w-12 h-12 border-2 border-gray-300 rounded-full" alt="Anonymous's avatar" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&faces=1&faceindex=1&facepad=2.5&w=500&h=500&q=80">
            <div class="flex-col mt-1">

                <div class="flex items-center flex-1 px-3 font-bold leading-tight text-gray-900 dark:text-gray-100">
                    <?php echo $title ?>
                    <span class="ml-2 text-xs font-normal dark:text-gray-300 text-gray-500">
                        <?php echo calculateRelativeTime($timestamp) ?>
                    </span>
                </div>

                <div class="ml-3 my-4 flex items-center text-yellow-300">
                    <?php for ($i = 1; $i <= $rating; $i++) { ?>
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    <?php } ?>
                </div>

                <div class="flex-1 px-2 ml-2 text-sm font-medium leading-relaxed dark:text-gray-200 text-gray-600">
                    <?php echo $desc ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>