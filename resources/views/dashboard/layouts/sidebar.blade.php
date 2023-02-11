<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" {{ Request::is('dashboard/pengisiannilai') ? 'active' : '' }}" href="/dashboard/pengisiannilai">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Pengisian Nilai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" {{ Request::is('dashboard/cetakvakasi') ? 'active' : '' }}" href="/dashboard/cetakvakasi">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Cetak Vakasi
                </a>
            </li>
            {{-- <li class="nav-item">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Cetak Vakasi
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" {{ Request::is('dashboard/cetakvakasi') ? 'active' : '' }}" href="/dashboard/cetakvakasi">
                                        <span data-feather="file" class="align-text-bottom"></span>
                                        UTS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Request::is('dashboard/pengisiannilai') ? 'active' : '' }}" href="/dashboard/pengisiannilai">
                                        <span data-feather="file" class="align-text-bottom"></span>
                                        UAS
                                    </a>
                                </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    
                  </div>
            </li>               --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/tahunakademiks*') ? 'active' : '' }}" href="/dashboard/tahunakademiks">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Tahun Akademik
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/vakasinilais*') ? 'active' : '' }}" href="/dashboard/vakasinilais">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Master Data Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/settingvakasis*') ? 'active' : '' }}" href="/dashboard/settingvakasis">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Pengaturan Vakasi
                </a>
            </li>
        </ul>
    </div>
</nav>


