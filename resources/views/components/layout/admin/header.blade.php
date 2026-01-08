 <header class="pc-header">
     <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
         <div class="me-auto pc-mob-drp">
             <ul class="list-unstyled">
                 <!-- ======= Menu collapse Icon ===== -->
                 <li class="pc-h-item pc-sidebar-collapse">
                     <a href="javascript:void(0)" class="pc-head-link ms-0" id="sidebar-hide">
                         <i>
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-row-vertical"></use>
                             </svg>
                         </i>
                     </a>
                 </li>
                 <li class="pc-h-item pc-sidebar-popup">
                     <a href="javascript:void(0)" class="pc-head-link ms-0" id="mobile-collapse">
                         <i>
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-row-vertical"></use>
                             </svg>
                         </i>
                     </a>
                 </li>
                 {{-- <li class="pc-h-item d-none d-md-inline-flex">
                     Dinas Komunikasi, Informatika dan Statistik
                 </li> --}}
             </ul>
         </div>
         <!-- [Mobile Media Block end] -->
         <div class="ms-auto">
             <ul class="list-unstyled">
                 <li class="pc-h-item mx-2">
                     <a href="javascript:void(0)" class="button-dark text-muted" onclick="layout_change('dark')">
                         <svg class="pc-icon">
                             <use xlink:href="#custom-moon"></use>
                         </svg>
                     </a>
                     <a href="javascript:void(0)" class="button-light text-muted" onclick="layout_change('light')">
                         <svg class="pc-icon">
                             <use xlink:href="#custom-sun-1"></use>
                         </svg>
                     </a>
                 </li>

                 <li class="pc-h-item">
                     |
                 </li>
                 <li class="pc-h-item">
                     <a class="arrow-none mx-2 text-muted" href="<?= route('beranda') ?>" role="button"
                         target="_blank">
                         <svg class="pc-icon">
                             <use xlink:href="#custom-airplane"></use>
                         </svg>
                         Landing Page
                     </a>

                 </li>
                 <li class="dropdown pc-h-item header-user-profile">
                     <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                         role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                         <img src="{{ asset('assets/admin/images/user/avatar-2.jpg') }}" alt="user-image"
                             class="user-avtar" />
                     </a>
                     <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                         <div class="dropdown-header d-flex align-items-center justify-content-between">
                             <h5 class="m-0">Profile</h5>
                         </div>
                         <div class="dropdown-body">
                             <div class="profile-notification-scroll position-relative"
                                 style="max-height: calc(100vh - 225px)">
                                 <div class="d-flex mb-1">
                                     <div class="flex-shrink-0">
                                         <img src="{{ auth()->user()->avatar ? auth()->user()->avatar : asset('assets/admin/images/user/avatar-1.jpg') }}"
                                             alt="user-image" class="user-avtar wid-35" style="height: 35px;" />
                                     </div>
                                     <div class="flex-grow-1 ms-3">
                                         <h6 class="mb-1">{{ auth()->user()->name }} 🖖</h6>
                                         <span>{{ auth()->user()->email }}</span>
                                     </div>
                                 </div>

                                 {{-- <hr class="border-secondary border-opacity-50" /> --}}

                                 {{-- <a href="#" class="dropdown-item">
                                     <span>
                                         <svg class="pc-icon text-muted me-2">
                                             <use xlink:href="#custom-setting-outline"></use>
                                         </svg>
                                         <span>Settings</span>
                                     </span>
                                 </a>
                                 <a href="#" class="dropdown-item">
                                     <span>
                                         <svg class="pc-icon text-muted me-2">
                                             <use xlink:href="#custom-share-bold"></use>
                                         </svg>
                                         <span>Share</span>
                                     </span>
                                 </a>
                                 <a href="#" class="dropdown-item">
                                     <span>
                                         <svg class="pc-icon text-muted me-2">
                                             <use xlink:href="#custom-lock-outline"></use>
                                         </svg>
                                         <span>Change Password</span>
                                     </span>
                                 </a> --}}

                                 <hr class="border-secondary border-opacity-50" />
                                 <div class="d-grid mb-3">
                                     <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button class="btn btn-primary w-100">
                                             <svg class="pc-icon me-2">
                                                 <use xlink:href="#custom-logout-1-outline"></use>
                                             </svg>Logout
                                         </button>
                                     </form>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </header>
