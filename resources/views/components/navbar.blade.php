<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="#">ConnectFriend</a>

      <!-- Toggle Button for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
              </li>
          </ul>

          <!-- Right Section -->
          <ul class="navbar-nav">
              <!-- Notification Dropdown -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle position-relative d-flex align-items-center" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-bell me-1"></i> Notifications
                      <!-- Mock Notification Count -->
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          3
                          <span class="visually-hidden">unread notifications</span>
                      </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                      <li class="dropdown-header">Notifications</li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <small>2 hours ago</small><br>
                              Notification message 1
                          </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <small>5 hours ago</small><br>
                              Notification message 2
                          </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <a class="dropdown-item text-center" href="#">View All</a>
                      </li>
                  </ul>
              </li>

              <!-- Profile Dropdown -->
              <li class="nav-item dropdown ms-4"> <!-- Added 'ms-4' for spacing -->
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-person-circle me-1"></i> Profile
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                      <li><a class="dropdown-item" href="#">Profile</a></li>
                      <li><a class="dropdown-item" href="#">Logout</a></li>
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>
