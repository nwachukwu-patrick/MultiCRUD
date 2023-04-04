<?php
use bootstrap\bootstrap;

require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

new classes\header();
$config = new conf\config();
$connection = new conf\connection();
$bootstrap = new bootstrap();
    if($connection->insertIntoCart(0,2,21,1)){
    echo 'added';
    }else{
        echo 'could not add to cart';
    }
if($request = $_GET['request']){
    if($request == 'requested'){
        echo 'requested';
    }
}
?>
<div id="display" style="height: 50%;width: 100%;"></div>
<button class="btn btn-success" onclick="request('hi')">hi</button><br><br>
<button class="btn btn-success" onclick="request('hello')">hello</button><br><br>
<button class="btn btn-success" onclick="request('howfar')">howfar</button><br><br>
<button class="btn btn-success" onclick="request('kway')">k way</button><br><br>
<?php
$bootstrap->loadJs('index.js');

?>


</li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>