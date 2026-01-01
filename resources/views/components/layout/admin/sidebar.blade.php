 <nav class="pc-sidebar">
     <div class="navbar-wrapper">
         <div class="m-header">
             <a href="{{ route('admin.dashboard.index') }}" class="b-brand text-primary">
                 <!-- ========   Change your logo from here   ============ -->
                 <img src="{{ asset('assets/admin/images/logo.png') }}" class="img-fluid logo-lg" style="height: 36px"
                     alt="logo" />
                 <span class="badge bg-light-success rounded-pill ms-2 theme-version">v2.0.0</span>
             </a>
         </div>
         <div class="navbar-content">
             <div class="card pc-user-card">
                 <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <img src="{{ asset('assets/admin/images/user/avatar-1.jpg') }}" alt="user-image"
                                 class="user-avtar wid-45 rounded-circle" />
                         </div>
                         <div class="flex-grow-1 ms-3 me-2" style="max-width: 120px">
                             <h6 class="mb-0 text-truncate">Jonh Smith</h6>
                             <small>Administrator</small>
                         </div>
                         <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                             href="#pc_sidebar_userlink">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-sort-outline"></use>
                             </svg>
                         </a>
                     </div>
                     <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                         <div class="pt-3">
                             {{-- <a href="#!">
                                 <i class="ti ti-user"></i>
                                 <span>My Account</span>
                             </a>
                             <a href="#!">
                                 <i class="ti ti-settings"></i>
                                 <span>Settings</span>
                             </a>
                             <a href="#!">
                                 <i class="ti ti-lock"></i>
                                 <span>Lock Screen</span>
                             </a> --}}
                             <a href="#!">
                                 <i class="ti ti-power"></i>
                                 <span>Keluar</span>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>

             <ul class="pc-navbar">
                 {{-- <li class="pc-item pc-caption">
                     <label>Navigation</label>
                 </li> --}}

                 <li class="pc-item">
                     <a href="{{ route('admin.dashboard.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-home"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Dashboard</span>
                     </a>
                 </li>

                 <li class="pc-item pc-caption">
                     <label>Indeks Kepuasan Masyarakat</label>
                 </li>
                 <li class="pc-item">
                     <a href="{{ route('admin.skm.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-status-up"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">IKM OPD</span>
                     </a>
                 </li>
                 <li class="pc-item">
                     <a href="{{ route('admin.dashboard.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-notification-status"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">IKM Provinsi</span>
                     </a>
                 </li>


                 <li class="pc-item pc-caption">
                     <label>Laporan</label>
                 </li>
                 <li class="pc-item">
                     <a href="{{ route('admin.dashboard.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-document"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Laporan</span>
                     </a>
                 </li>

                 <li class="pc-item pc-caption">
                     <label>Master Data</label>
                 </li>
                 <li class="pc-item">
                     <a href="{{ route('admin.element.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-layer"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Unsur</span>
                     </a>
                 </li>

                 <li class="pc-item">
                     <a href="{{ route('admin.answer_option.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-text-align-justify-center"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Opsi Jawaban</span>
                     </a>
                 </li>

                 <li class="pc-item">
                     <a href="{{ route('admin.question.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-notification-status"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Pertanyaan</span>
                     </a>
                 </li>

                 <li class="pc-item">
                     <a href="{{ route('admin.unor.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-box-1"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Unit Organisasi</span>
                     </a>
                 </li>

             </ul>
         </div>
     </div>
 </nav>
