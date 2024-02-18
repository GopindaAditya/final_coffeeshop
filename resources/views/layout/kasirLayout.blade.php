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
  <title>Kasir</title>
</head>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head> --}}
<body style = "font-family: Bebas neue;">

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-content">
        <h2>JAMUNE BIYUNG</h2>
        <a href="/kasir/menu"><svg width="24" height="26" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18.9901 0H7.6766C5.6406 0 3.688 0.732901 2.24836 2.03757C0.808719 3.34225 0 5.11186 0 6.95691V17.2098C0 19.0549 0.808719 20.8244 2.24836 22.1291C3.688 23.4338 5.64067 24.1667 7.6766 24.1667H18.9901C21.0261 24.1667 22.9787 23.4338 24.4183 22.1291C25.8579 20.8244 26.6667 19.0548 26.6667 17.2098V6.95691C26.6667 5.11179 25.8579 3.34225 24.4183 2.03757C22.9787 0.732901 21.026 0 18.9901 0ZM7.67729 2.19695H18.9901C20.3818 2.20087 21.7152 2.70352 22.6995 3.59527C23.6835 4.4873 24.2382 5.69562 24.2425 6.95691V7.32299L2.8283 7.32323C2.68977 7.32495 2.55287 7.34972 2.42436 7.3963V6.95691C2.42868 5.69562 2.98333 4.4873 3.96733 3.59527C4.95164 2.7035 6.28496 2.20084 7.67673 2.19695L7.67729 2.19695ZM16.162 21.9695H10.5054V16.8432H16.162V21.9695ZM16.162 14.6461H10.5054V9.51981H16.162V14.6461ZM2.42436 9.44675C2.55287 9.49333 2.68977 9.5181 2.8283 9.52006H8.08096V14.6464L2.8283 14.6461C2.68977 14.6481 2.55287 14.6728 2.42436 14.7194V9.44675ZM2.42436 17.2095V16.7701C2.55287 16.8167 2.68977 16.8415 2.8283 16.8432H8.08096V21.9695H7.67674C6.28496 21.9656 4.95164 21.4629 3.96734 20.5712C2.98332 19.6791 2.42866 18.4708 2.42436 17.2095L2.42436 17.2095ZM18.9901 21.9695H18.5861V9.52031H24.2427L24.2425 17.2096C24.2381 18.4709 23.6835 19.6792 22.6995 20.5713C21.7152 21.463 20.3819 21.9657 18.9901 21.9696L18.9901 21.9695Z" fill="white"/>
          </svg>
           Dashboard</a>
        {{-- <a href=""><svg width="26" height="26" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_163_1284)">
          <path d="M12.1959 36.2359L18.2192 31.7185C18.3464 31.6225 18.5222 31.6225 18.6494 31.7185L24.6727 36.2359C25.458 36.8242 26.4344 37.0986 27.4111 37.0056C28.388 36.9127 29.295 36.459 29.9553 35.7334C30.6158 35.0076 30.9821 34.062 30.9829 33.081V10.8522C30.9812 9.61648 30.4897 8.43187 29.6161 7.55819C28.7422 6.68427 27.5576 6.19282 26.3219 6.19141H10.5471C9.31143 6.19285 8.12681 6.6843 7.25289 7.55819C6.37921 8.43187 5.88777 9.61642 5.88611 10.8522V33.081C5.88611 34.0625 6.25223 35.0086 6.91246 35.7347C7.57292 36.4607 8.48047 36.9144 9.45734 37.0071C10.4345 37.0998 11.4111 36.8249 12.1962 36.2359H12.1959ZM8.03696 10.8523C8.03768 10.187 8.30249 9.54912 8.77308 9.07857C9.24341 8.608 9.8813 8.34342 10.5468 8.34269H26.3222H26.3219C26.9874 8.34341 27.6253 8.60798 28.0956 9.07857C28.5662 9.54913 28.831 10.187 28.8318 10.8523V33.0811C28.8318 33.5272 28.6654 33.9572 28.365 34.2873C28.0649 34.6172 27.6525 34.8234 27.2083 34.8657C26.7642 34.9077 26.3205 34.7828 25.9635 34.5152L19.9403 29.9991C19.505 29.675 18.977 29.5 18.4344 29.5C17.8919 29.5 17.3639 29.675 16.9286 29.9991L10.9054 34.5152C10.5484 34.7828 10.1047 34.9077 9.66055 34.8657C9.21639 34.8234 8.80389 34.6172 8.50384 34.2873C8.20349 33.9572 8.03711 33.5272 8.03711 33.0811L8.03696 10.8523Z" fill="white"/>
          <path d="M14.1322 15.5131H22.7368C23.1212 15.5131 23.4763 15.3081 23.6683 14.9753C23.8604 14.6425 23.8604 14.2325 23.6683 13.8997C23.4763 13.567 23.1212 13.3619 22.7368 13.3619H14.1322C13.7478 13.3619 13.3928 13.567 13.2007 13.8997C13.0086 14.2325 13.0086 14.6426 13.2007 14.9753C13.3928 15.3081 13.7478 15.5131 14.1322 15.5131Z" fill="white"/>
          </g>
          <defs>
          <clipPath id="clip0_163_1284">
          <rect width="27" height="27" fill="white" transform="translate(0.886108 0.191406)"/>
          </clipPath>
          </defs>
          </svg>
          Stock</a> --}}
        <a href="/kasir/pesanan"><svg width="24" height="26" viewBox="0 0 34 36" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M24.2651 29.8458H9.73494C7.9045 29.8458 6.14903 29.0759 4.85474 27.7055C3.56044 26.3351 2.83337 24.4763 2.83337 22.5382V13.3075C2.83337 11.3694 3.56044 9.51069 4.85474 8.14027C6.14903 6.76984 7.90456 6 9.73494 6H24.2651C26.0956 6 27.8511 6.76984 29.1453 8.14027C30.4396 9.51069 31.1667 11.3695 31.1667 13.3075V22.5382C31.1667 24.4763 30.4396 26.3351 29.1453 27.7055C27.8511 29.0759 26.0955 29.8458 24.2651 29.8458ZM9.73494 8.30794C8.48368 8.3118 7.28497 8.84004 6.40004 9.77674C5.51536 10.7135 5.0167 11.9829 5.01284 13.3078V22.5385C5.01673 23.8634 5.51538 25.1328 6.40004 26.0696C7.28497 27.0063 8.48368 27.5345 9.73494 27.5384H24.2651C25.5164 27.5345 26.7151 27.0063 27.6 26.0696C28.4847 25.1328 28.9834 23.8634 28.9872 22.5385V13.3078C28.9833 11.9829 28.4847 10.7135 27.6 9.77674C26.7151 8.84002 25.5164 8.31176 24.2651 8.30794H9.73494Z" fill="white"/>
          <path d="M16.9966 19.0773C15.4597 19.0801 13.9665 18.5385 12.7539 17.5389L7.79926 13.4619C7.54823 13.2834 7.37869 13.0024 7.33077 12.6864C7.2831 12.3701 7.36166 12.0471 7.54751 11.7947C7.73359 11.5423 8.01016 11.3829 8.31131 11.3548C8.61245 11.3268 8.91115 11.4324 9.1359 11.6466L14.0905 15.7234C14.9226 16.4047 15.9447 16.7743 16.9966 16.7743C18.0484 16.7743 19.0705 16.4047 19.9026 15.7234L24.8572 11.6466C25.082 11.4324 25.3807 11.3268 25.6818 11.3548C25.9829 11.3829 26.2595 11.5423 26.4456 11.7947C26.6314 12.0471 26.71 12.3701 26.6623 12.6864C26.6144 13.0024 26.4449 13.2834 26.1939 13.4619L21.2392 17.5387V17.5389C20.0266 18.5385 18.5334 19.0801 16.9966 19.0773L16.9966 19.0773Z" fill="white"/>
          </svg>
          Order</a>
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
                <button class="btn">
                  Kasir
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="/">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          @yield('container')
          {{-- <div class="row">
            <div class="col">
              <div id="calendar-container"></div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>

<script src="../js/scriptOwner.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>