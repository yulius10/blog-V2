<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
  <li class="page-item">
    <a class="page-link" href="#">
      &larr;
    </a>
  </li>
  <?php
  for($i=1;$i<=3;$i++){
    ?>
    <li class="page-item">
      <a class="page-link" href="#">
        <?=$i?>
      </a>
    </li>
    <?php
  }
  ?>
  <li class="page-item disabled">
    <a class="page-link" href="#">
      &rarr;
    </a>
  </li>
</ul>
<!-- /Pagination -->
