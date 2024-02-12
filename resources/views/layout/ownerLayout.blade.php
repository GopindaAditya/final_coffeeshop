<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../css/styleOwner.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Owner</title>
</head>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}

<body style = "font-family: Bebas neue;">

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-content">
        <h2>COFFEE MASBROO</h2>
        <a href="/owner/menu"><svg width="24" height="26" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18.9901 0H7.6766C5.6406 0 3.688 0.732901 2.24836 2.03757C0.808719 3.34225 0 5.11186 0 6.95691V17.2098C0 19.0549 0.808719 20.8244 2.24836 22.1291C3.688 23.4338 5.64067 24.1667 7.6766 24.1667H18.9901C21.0261 24.1667 22.9787 23.4338 24.4183 22.1291C25.8579 20.8244 26.6667 19.0548 26.6667 17.2098V6.95691C26.6667 5.11179 25.8579 3.34225 24.4183 2.03757C22.9787 0.732901 21.026 0 18.9901 0ZM7.67729 2.19695H18.9901C20.3818 2.20087 21.7152 2.70352 22.6995 3.59527C23.6835 4.4873 24.2382 5.69562 24.2425 6.95691V7.32299L2.8283 7.32323C2.68977 7.32495 2.55287 7.34972 2.42436 7.3963V6.95691C2.42868 5.69562 2.98333 4.4873 3.96733 3.59527C4.95164 2.7035 6.28496 2.20084 7.67673 2.19695L7.67729 2.19695ZM16.162 21.9695H10.5054V16.8432H16.162V21.9695ZM16.162 14.6461H10.5054V9.51981H16.162V14.6461ZM2.42436 9.44675C2.55287 9.49333 2.68977 9.5181 2.8283 9.52006H8.08096V14.6464L2.8283 14.6461C2.68977 14.6481 2.55287 14.6728 2.42436 14.7194V9.44675ZM2.42436 17.2095V16.7701C2.55287 16.8167 2.68977 16.8415 2.8283 16.8432H8.08096V21.9695H7.67674C6.28496 21.9656 4.95164 21.4629 3.96734 20.5712C2.98332 19.6791 2.42866 18.4708 2.42436 17.2095L2.42436 17.2095ZM18.9901 21.9695H18.5861V9.52031H24.2427L24.2425 17.2096C24.2381 18.4709 23.6835 19.6792 22.6995 20.5713C21.7152 21.463 20.3819 21.9657 18.9901 21.9696L18.9901 21.9695Z" fill="white"/>
          </svg>
           Dashboard</a>
          {{-- <a href="/owner/menu"><svg width="26" height="25" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.8649 6.48306H10.9073C9.02307 6.48306 7.21597 7.21013 5.88361 8.50443C4.55125 9.79872 3.8028 11.5542 3.8028 13.3846V22.1025C3.8028 23.9329 4.55125 25.6884 5.88361 26.9827C7.21597 28.277 9.02313 29.0041 10.9073 29.0041H25.8649C27.7492 29.0041 29.5563 28.277 30.8886 26.9827C32.221 25.6884 32.9695 23.9329 32.9695 22.1025V13.3846C32.9695 11.5542 32.221 9.79872 30.8886 8.50443C29.5563 7.21013 27.7491 6.48306 25.8649 6.48306ZM6.04649 15.927H10.9075C11.5755 15.927 12.1928 16.2731 12.5268 16.8353C12.8606 17.3972 12.8606 18.0895 12.5268 18.6513C12.1928 19.2135 11.5755 19.5596 10.9075 19.5596H6.04649V15.927ZM30.7258 22.1023C30.7218 23.3535 30.2084 24.5525 29.2978 25.4371C28.3868 26.3218 27.1528 26.8207 25.8648 26.8243H10.9072C9.61915 26.8207 8.38519 26.3218 7.47424 25.4371C6.56354 24.5525 6.05021 23.3535 6.04624 22.1023V21.7391H10.9072C12.3768 21.7391 13.7347 20.9775 14.4694 19.7411C15.2043 18.5049 15.2043 16.9817 14.4694 15.7456C13.7347 14.5092 12.3768 13.7475 10.9072 13.7475H6.04624V13.3844C6.05024 12.1331 6.56356 10.9342 7.47424 10.0495C8.38519 9.1648 9.61915 8.66589 10.9072 8.66228H25.8648C27.1528 8.66593 28.3868 9.16482 29.2978 10.0495C30.2085 10.9342 30.7218 12.1331 30.7258 13.3844V22.1023Z" fill="white"/>
          </svg>
          Edit Menu</a> --}}
          <a href="/owner/laporan"><svg width="24" height="26" viewBox="0 0 34 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24.2651 29.8458H9.73494C7.9045 29.8458 6.14903 29.0759 4.85474 27.7055C3.56044 26.3351 2.83337 24.4763 2.83337 22.5382V13.3075C2.83337 11.3694 3.56044 9.51069 4.85474 8.14027C6.14903 6.76984 7.90456 6 9.73494 6H24.2651C26.0956 6 27.8511 6.76984 29.1453 8.14027C30.4396 9.51069 31.1667 11.3695 31.1667 13.3075V22.5382C31.1667 24.4763 30.4396 26.3351 29.1453 27.7055C27.8511 29.0759 26.0955 29.8458 24.2651 29.8458ZM9.73494 8.30794C8.48368 8.3118 7.28497 8.84004 6.40004 9.77674C5.51536 10.7135 5.0167 11.9829 5.01284 13.3078V22.5385C5.01673 23.8634 5.51538 25.1328 6.40004 26.0696C7.28497 27.0063 8.48368 27.5345 9.73494 27.5384H24.2651C25.5164 27.5345 26.7151 27.0063 27.6 26.0696C28.4847 25.1328 28.9834 23.8634 28.9872 22.5385V13.3078C28.9833 11.9829 28.4847 10.7135 27.6 9.77674C26.7151 8.84002 25.5164 8.31176 24.2651 8.30794H9.73494Z" fill="white"/>
            <path d="M16.9966 19.0773C15.4597 19.0801 13.9665 18.5385 12.7539 17.5389L7.79926 13.4619C7.54823 13.2834 7.37869 13.0024 7.33077 12.6864C7.2831 12.3701 7.36166 12.0471 7.54751 11.7947C7.73359 11.5423 8.01016 11.3829 8.31131 11.3548C8.61245 11.3268 8.91115 11.4324 9.1359 11.6466L14.0905 15.7234C14.9226 16.4047 15.9447 16.7743 16.9966 16.7743C18.0484 16.7743 19.0705 16.4047 19.9026 15.7234L24.8572 11.6466C25.082 11.4324 25.3807 11.3268 25.6818 11.3548C25.9829 11.3829 26.2595 11.5423 26.4456 11.7947C26.6314 12.0471 26.71 12.3701 26.6623 12.6864C26.6144 13.0024 26.4449 13.2834 26.1939 13.4619L21.2392 17.5387V17.5389C20.0266 18.5385 18.5334 19.0801 16.9966 19.0773L16.9966 19.0773Z" fill="white"/>
            </svg>
            History</a>

          <a href = "/" class = "logout-button"><svg width="37" height="28" viewBox="0 0 37 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3.08331 5.83339C3.08331 3.90037 5.15402 2.33334 7.70838 2.33334H18.5C21.0543 2.33334 23.125 3.90037 23.125 5.83339V8.75003C23.125 9.39439 22.4349 9.91665 21.5834 9.91665C20.732 9.91665 20.0416 9.39439 20.0416 8.75003V5.83339C20.0416 5.18903 19.3515 4.66658 18.5 4.66658H7.70838C6.8569 4.66658 6.16651 5.18903 6.16651 5.83339V22.1666C6.16651 22.811 6.8569 23.3334 7.70838 23.3334H18.5C19.3515 23.3334 20.0416 22.811 20.0416 22.1666V19.25C20.0416 18.6056 20.732 18.0834 21.5834 18.0834C22.4349 18.0834 23.125 18.6056 23.125 19.25V22.1666C23.125 24.0999 21.0543 25.6667 18.5 25.6667H7.70838C5.15402 25.6667 3.08331 24.0999 3.08331 22.1666V5.83339Z" fill="white"/>
          <path d="M24.6637 17.5C24.6637 17.942 24.9938 18.3459 25.5159 18.5436C26.0383 18.741 26.6634 18.6985 27.1306 18.4334L33.2972 14.9334C33.6854 14.7128 33.9138 14.3671 33.9138 13.9999C33.9138 13.6327 33.6854 13.287 33.2972 13.0665L27.1306 9.56648C26.6634 9.30144 26.0383 9.25867 25.5159 9.45632C24.9938 9.65398 24.6637 10.0579 24.6637 10.4999V12.8333H16.9557C16.1042 12.8333 15.4138 13.3556 15.4138 13.9999C15.4138 14.6443 16.1042 15.1666 16.9557 15.1666H24.6637V17.5Z" fill="white"/>
          </svg>Logout</a>
                    
      </div>
    </div>

    <!-- Page content -->
    <div class="page-content">
      <div class="top-bar">
        <!-- Search Bar -->
        <div class="container-fluid">
          <div class="row mb-4">
            <div class="col">
              <div class="input-group mb-3 mt-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                <input type="text" id="search" oninput="search()" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>
            </div>
            <div class="col-auto d-flex align-items-center">
              <!-- Foto Profil -->
              <div class="profile-photo p-3">
                <img style = "width :30px;" src="../storage/Foto 2.jpg" alt="Your Profile Image" class="rounded-circle">
              </div>
              <!-- Dropdown Menu -->
              <div class="dropdown">
                <button class="btn" type="button">
                  Owner
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="/">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div id="calendar-container"></div>
            </div>
            @yield('container')
          </div>
        </div>
      </div>
    </div>

<script src="../js/scriptOwner.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>