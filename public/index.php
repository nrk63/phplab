<?php

require "../vendor/autoload.php";
require "../app/User.php";
require "../app/Comment.php";

use nrk63\User;
use nrk63\Comment;

try {
    $user0 = new User(-3, "Kyle", "kyle@example.io", "qwerty");
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

$user0 = new User(1, "Kyle", "kyle@example2.io", "fdsaZzXcvd$#r3211f!");
echo $user0->getCreationDate() . "\n";

echo 'Enter a date: ';
$user_input = readline();
$datetime = strtotime($user_input);
if (!$datetime) {
    echo 'bad date';
    return;
}

echo 'DateTime is ' .  $datetime . "\n";

$comments = array(
    new Comment(new User(1, "Kyle", "kyle@example3.io", "fvknvpxoon##$#"),
                "Hello, Friends"),
    new Comment(new User(2, "Aron", "aron@example4.io", "zcvCCC3!@"),
                "Nice to meet you"),
    new Comment(new User(2, "Bill", "bill@example4.io", "zcvCCC3!@"),
                "Not good")
);

foreach ($comments as $comment) {
    if ($comment->getUser()->getCreationDate() < $datetime) {
        echo $comment->getText() . "\n";
    }
}
