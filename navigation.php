<?php 
session_start();
$userID = $_SESSION['user_id'];

?>
<nav class="navbar navbar-expand-sm navbar-dark py-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">LebMenu</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapsibleNavbar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
              <a class="nav-link mx-4 px-2" href="home.php">Home</a>
            </li>
            <?php if($userID!=null){?> 
            <li class="nav-item">
              <a class="nav-link mx-4 px-2" href="saved.php">Saved</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link mx-4 px-2" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-4 px-2" href="contactUs.php">Contact Us</a>
            </li>
          </ul>
          <form method="POST">
          <button type="submit" class="btn btn-danger float-start mx-4 px-2" name="logout"  >
            Logout
          </button>
          </form>
        </div>
      </div>
    </nav>
    <?php 
    if(isset($_POST['logout']))
    {
     session_destroy();
     header("location:login.php");

    }
    ?>
    <script>
      /*this part of script is to let one of the navigation bar be active when the user or the admin is oin this page
        that mean if the user click on the navigation home for example then the navigation is active and it 
        is on */
    activeLink = window.location.href; // activelink function
    console.log(activeLink)
    let link = document.getElementsByTagName("a");
    for(let i=0;i<link.length;i++)
    {
       link[i].classList.remove("active");
      
    }
    for(let i=0;i<link.length;i++)
    {
       if(link[i].href===activeLink)
       {
        link[i].classList.add("active")
        console.log(link[i].parentElement)
       }
    }
</script>