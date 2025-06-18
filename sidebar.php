<?php require "header.php"; ?>
<div class="sidebar" id="sidebar">
    
    <div>
    <div class="topbar">

<div><img src="https://i.pravatar.cc/100" class="profile-pic" /></div>
</div>
      <p class="username">User Name</p>
      <ul>
        <li><i class="fas fa-home"></i> <span>Home</span></li>
        <li><i class="fas fa-calendar"></i> <span>Calendar</span></li>
        <li><i class="fas fa-chart-bar"></i> <span>Reports</span></li>
        <li><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></li>
        <li><i class="fas fa-address-book"></i> <span>Contacts</span></li>
      </ul>
    </div>
    <button class="toggle-btn">Get Started</button>
  </div>

  <div class="main" id="main">


    <div class="cards">
      <div class="card">
      <div class="toggle-hide" onclick="toggleSidebar()"><strong><i class="fas fa-bars"></i></strong></div>
      </div>
    </div>




  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }
  </script>