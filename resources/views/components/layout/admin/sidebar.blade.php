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
                             <img src="{{ auth()->user()->avatar ? auth()->user()->avatar : asset('assets/admin/images/user/avatar-1.jpg') }}"
                                 alt="user-image" class="user-avtar wid-45 rounded-circle" style="height: 45px" />
                         </div>
                         <div class="flex-grow-1 ms-3 me-2" style="max-width: 120px">
                             <h6 class="mb-0 text-truncate">{{ auth()->user()->name }}</h6>
                             <small>{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</small>
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
                             <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <a href="javascript:void(0);"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                     <i class="ti ti-power"></i>
                                     <span>Keluar</span>
                                 </a>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>

             <ul class="pc-navbar">
                 {{-- <li class="pc-item pc-caption">
                     <label>Navigation</label>
                 </li> --}}
                 @can('dashboard.view')
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
                 @endcan

                 @canany(['skm.view', 'ikm.view'])
                     <li class="pc-item pc-caption">
                         <label>Indeks Kepuasan Masyarakat</label>
                     </li>
                 @endcan

                 @can('skm.view')
                     <li class="pc-item">
                         <a href="{{ route('admin.skm.index') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-status-up"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Daftar IKM OPD</span>
                         </a>
                     </li>
                 @endcan

                 @can('skm.show-by-unor')
                     <li class="pc-item">
                         @if (auth()->user()->unor_id == null)
                             <a href="javascript:void(0);"
                                 onclick="return alert('Anda belum terdaftar di OPD manapun. Silahkan hubungi Admin untuk melakukan pendaftaran.')"
                                 class="pc-link">
                                 <span class="pc-micon">
                                     <svg class="pc-icon">
                                         <use xlink:href="#custom-status-up"></use>
                                     </svg>
                                 </span>
                                 <span class="pc-mtext">IKM OPD</span>
                             </a>
                         @else
                             <a href="{{ route('admin.skm.by-unor') }}" class="pc-link">
                                 <span class="pc-micon">
                                     <svg class="pc-icon">
                                         <use xlink:href="#custom-status-up"></use>
                                     </svg>
                                 </span>
                                 <span class="pc-mtext">IKM OPD</span>
                             </a>
                         @endif
                     </li>
                 @endcan

                 @can('ikm.view')
                     <li class="pc-item">
                         <a href="{{ route('admin.ikm.index') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-notification-status"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">IKM Provinsi Gorontalo</span>
                         </a>
                     </li>
                 @endcan


                 <li class="pc-item pc-caption">
                     <label>Laporan</label>
                 </li>
                 @can('report.analytic-respondent')
                     <li class="pc-item">
                         <a href="{{ route('admin.report.analytic-respondents') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-document"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Lap. Analisis Responden</span>
                         </a>
                     </li>
                 @endcan

                 @can('report.analytic-respondent-by-unor')
                     <li class="pc-item">
                         <a href="{{ route('admin.report.analytic-respondents-by-unor') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-document"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Lap. Analisis Responden</span>
                         </a>
                     </li>
                 @endcan

                 @can('report.ikm-by-service')
                     <li class="pc-item">
                         <a href="{{ route('admin.report.ikm-by-service') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-document"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Lap. IKM Per Layanan</span>
                         </a>
                     </li>
                 @endcan
                 @can('report.ikm-by-service-by-unor')
                     <li class="pc-item">
                         <a href="{{ route('admin.report.ikm-by-service-by-unor') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-document"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Lap. IKM Per Layanan</span>
                         </a>
                     </li>
                 @endcan

                 {{-- <li class="pc-item">
                     <a href="{{ route('admin.user.index') }}" class="pc-link">
                         <span class="pc-micon">
                             <svg class="pc-icon">
                                 <use xlink:href="#custom-user"></use>
                             </svg>
                         </span>
                         <span class="pc-mtext">Pengguna</span>
                     </a>
                 </li> --}}

                 @canany(['user.view', 'role.view'])
                     <li class="pc-item pc-caption">
                         <label>Manajemen Pengguna</label>
                     </li>
                 @endcan

                 @can('user.view')
                     <li class="pc-item">
                         <a href="{{ route('admin.user.index') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-user"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Pengguna</span>
                         </a>
                     </li>
                 @endcan

                 @can('role.view')
                     <li class="pc-item">
                         <a href="{{ route('admin.role.index') }}" class="pc-link">
                             <span class="pc-micon">
                                 <svg class="pc-icon">
                                     <use xlink:href="#custom-shopping-bag"></use>
                                 </svg>
                             </span>
                             <span class="pc-mtext">Peran (Role)</span>
                         </a>
                     </li>
                 @endcan

                 @canany(['element.view', 'answer_option.view', 'question.view', 'unor.view'])
                     <li class="pc-item pc-caption">
                         <label>Master Data</label>
                     </li>
                 @endcan

                 @can('element.view')
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
                 @endcan

                 @can('answer-option.view')
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
                 @endcan


                 @can('question.view')
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
                 @endcan


                 @can('unor.view')
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
                 @endcan

             </ul>
         </div>
     </div>
 </nav>
