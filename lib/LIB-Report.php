<?php
class Report extends Core {
  // (A) ADS LIST
  function adlist ($from, $to) {
    // (A1) DATE CHECK
    if (strtotime($to) < strtotime($from)) {
      exit("Date to ($to) cannot be earlier than date from ($from)!");
    }

    // (A2) OUTPUT CSV
    header("Content-Disposition: attachment; filename=adlist.csv;");
    $f = fopen("php://output", "w");
    fputcsv($f, ["Date", "Title", "Summary", "Posted By", "Email", "Tel"]);
    $this->DB->query(
      "SELECT *, DATE_FORMAT(`cla_date`, '".DT_LONG."') `cd`
       FROM `classifieds`
       WHERE `cla_date` BETWEEN ? AND ?
       ORDER BY `cla_date`",
      [$from, $to]
    );
    while ($r = $this->DB->stmt->fetch()) {
      fputcsv($f, [
        $r["cd"], $r["cla_title"], $r["cla_summary"], $r["cla_person"], $r["cla_email"], $r["cla_tel"]
      ]);
    }
    fclose($f);
  }
}