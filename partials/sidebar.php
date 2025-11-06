<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Sidebar -->
<nav class="bg-dark text-white vh-100 p-3" id="sidebar">
  <ul class="nav flex-column gap-2">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link text-white bg-primary rounded px-3 py-2 d-flex align-items-center justify-content-between" href="index.php">
        <span><i class="bi bi-grid me-2"></i> Dashboard</span>
      </a>
    </li>

    <!-- Applicants -->
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#customers" role="button" aria-expanded="false">
        <span><i class="bi bi-people me-2"></i> Applicants</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="customers">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="newcustomers.php">Pending Approval</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="approvedcustomers.php">Approved</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="rejectedcustomers.php">Rejected</a></li>
        </ul>
      </div>
    </li>

        <!-- Employers -->
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#employers" role="button" aria-expanded="false">
        <span><i class="bi bi-people me-2"></i> Employers</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="employers">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="newemployers.php">Pending Approval</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="approvedemployers.php">Approved</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="rejectedemployers.php">Rejected</a></li>
        </ul>
      </div>
    </li>

    <!-- Payments -->
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#payments" role="button" aria-expanded="false">
        <span><i class="bi bi-cash-stack me-2"></i> Jobs</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="payments">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="activejobs.php">Active Jobs</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="closedjobs.php">Closed Jobs</a></li>
          <!--<li class="nav-item"><a class="nav-link text-white-50" href="approvedservpayments.php">Service Payments</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="rejectedpayments.php">Rejected</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="completedsupply.php">Supply Payment</a></li> -->
        </ul>
      </div>
    </li>

    <!-- Orders -->
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#orders" role="button" aria-expanded="false">
        <span><i class="bi bi-box-seam me-2"></i> Payments</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="orders">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="pendingpayments.php">Pending Approval</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="approvedpayments.php">Approved</a></li>
          <!--<li class="nav-item"><a class="nav-link text-white-50" href="ordersshipping.php">Under Shipment</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="deliveredorders.php">Delivered</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="rejectedorders.php">Rejected</a></li> -->
        </ul>
      </div>
    </li>

    <!--
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#supply" role="button" aria-expanded="false">
        <span><i class="bi bi-truck me-2"></i> Supply Management</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="supply">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="newsupply.php">New Supply Requests</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="approvedsupply.php">Approved Supplies</a></li>
        </ul>
      </div>
    </li>

  
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#services" role="button" aria-expanded="false">
        <span><i class="bi bi-gear me-2"></i> Services</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="services">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="newbookings.php">New Bookings</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="assignedtechnician.php">Assigned Technicians</a></li>
          <li class="nav-item"><a class="nav-link text-white-50" href="completedservices.php">Completed Services</a></li>
        </ul>
      </div>
    </li>  -->

    <!-- Feedback -->
    <li class="nav-item">
      <a class="nav-link text-white px-3 py-2 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#feedback" role="button" aria-expanded="false">
        <span><i class="bi bi-chat-left-text me-2"></i> Feedback History</span>
        <i class="bi bi-chevron-right transition"></i>
      </a>
      <div class="collapse" id="feedback">
        <ul class="nav flex-column ms-4 mt-1">
          <li class="nav-item"><a class="nav-link text-white-50" href="feedback.php">Feedback</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Rotate Arrows Script -->
<script>
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(trigger => {
    const icon = trigger.querySelector('.bi-chevron-right');
    const target = document.querySelector(trigger.getAttribute('href'));
    target.addEventListener('shown.bs.collapse', () => icon.classList.add('rotate-down'));
    target.addEventListener('hidden.bs.collapse', () => icon.classList.remove('rotate-down'));
  });
</script>

<!-- Rotation effect -->
<style>
  .rotate-down { transform: rotate(90deg); transition: transform 0.3s ease; }
  .transition { transition: transform 0.3s ease; }
</style>
