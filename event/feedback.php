<?php
//не нашёл применения єтого скрипта
include RD . '/lib/feedback_class.php';
$feedback = new feedback;
$feedback_htm = RD . "/tpl/feedback.htm";
if (file_exists("$feedback_htm")) {
    $feedback_window = file_get_contents($feedback_htm);
}
$content = str_replace("{work_window}", $config->one_side_content($feedback_window, "", ""), $content);
if ($w == "") {
    if ($conf == "") {
        $content = str_replace("{feedback}", $feedback->show_feedback(), $content);
    }
    if ($conf == "true") {
        $content = str_replace("{feedback}", $feedback->save_send_message(), $content);
    }
    $content = str_replace("{feedback_caption}", "Обратная связь", $content);
}
$content = str_replace("{navigation}", $slave->show_navigation($dep_cur, ""), $content);
?>


