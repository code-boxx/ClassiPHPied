<?php require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<h3 class="mb-3">REPORTS</h3>
<div class="d-flex flex-wrap">
  <!-- (A) ADS CSV -->
  <form class="m-1 p-4 bg-white border" method="post" target="_blank" action="<?=HOST_BASE?>report/adlist">
    <div class="fw-bold text-danger mb-3">ADS LIST</div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">From</span>
      </div>
      <input type="date" class="form-control" name="from" required value="<?=date("Y-m-d", strtotime('-1 month'))?>">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">To</span>
      </div>
      <input type="date" class="form-control" name="to" required value="<?=date("Y-m-d")?>">
    </div>
    <input type="submit" class="col btn btn-primary" value="CSV">
  </form>
</div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>