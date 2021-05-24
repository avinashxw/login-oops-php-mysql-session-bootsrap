<?php
namespace LoginQ;

use \LoginQ\Member;

if(!empty($_SESSION['user_id'])) {

  require_once("class/Member.php");
  $member = new Member();

  $userloggedin = $member->getUserId($_SESSION['user_id']);
  //exit;
  if($userloggedin) {
    if(!empty($userloggedin[0]["display_name"])) {
      $displayName = ucwords($userloggedin[0]["display_name"]);
    } 
    else {
        $displayName = $userloggedin[0]["user_name"];
    }
  }
}

?>
<?php include('include/header.php'); ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Login</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="./logout.php">Sign out</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome <b><?php echo $displayName; ?></b>, You have successfully logged in!<br></h1>
    </main>
  </div>
</div>
<?php include('include/footer.php'); ?>