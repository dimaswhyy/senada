<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('dashboard.index')}}" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{asset('assets/backend/img/logo/logo.png')}}" width="40" height="40" alt="">
        </span>
        <span class="app-brand-text demo menu-text text-uppercase fw-bolder ms-2">Senada</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{Request::is('dashboard')?'active':''}}">
        <a href="{{route('dashboard.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      {{-- Super Admin --}}
      @if (Str::length(Auth::guard('account_yayasan')->user()) > 0)
      @if (Auth::guard('account_yayasan')->user()->role_id == 1)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Yayasan</span>
      </li>
      <li class="menu-item {{Request::is('profilyayasan')?'active':''}}">
        <a href="{{route('profilyayasan.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-school"></i>
          <div data-i18n="Analytics">Profil Yayasan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-data"></i>
          <div data-i18n="Account Settings">Kelola</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{Request::is('unit')?'active':''}}">
            <a href="{{route('unit.index')}}" class="menu-link">
              <div data-i18n="Account">Unit</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('unitaccount')?'active':''}}">
            <a href="{{route('unitaccount.index')}}" class="menu-link">
              <div data-i18n="Notifications">Akun</div>
            </a>
          </li>
        </ul>
      </li>
      @endif
      @endif
      {{-- Administrasi --}}
      @if (Str::length(Auth::guard('unit_account')->user()) > 0)
      @if (Auth::guard('unit_account')->user()->role_id == 2)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Administrator</span>
      </li>
      <li class="menu-item {{Request::is('profilsekolah')?'active':''}}">
        <a href="{{route('profilsekolah.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-school"></i>
          <div data-i18n="Analytics">Profil Sekolah</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-data"></i>
          <div data-i18n="Account Settings">Kelola</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{Request::is('guru')?'active':''}}">
            <a href="{{route('guru.index')}}" class="menu-link">
              <div data-i18n="Account">Data Guru</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('siswa')?'active':''}}">
            <a href="{{route('siswa.index')}}" class="menu-link">
              <div data-i18n="Notifications">Data Siswa</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('mapping')?'active':''}}">
            <a href="{{route('mapping.index')}}" class="menu-link">
              <div data-i18n="Notifications">Mapping Kelas</div>
            </a>
          </li>
        </ul>
      </li>
      @endif
      @endif
      {{-- Keuangan --}}
      @if (Str::length(Auth::guard('unit_account')->user()) > 0)
      @if (Auth::guard('unit_account')->user()->role_id == 3)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Keuangan</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
          <div data-i18n="Account Settings">Transaksi</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{Request::is('jenistransaksi')?'active':''}}">
            <a href="{{route('jenistransaksi.index')}}" class="menu-link">
              <div data-i18n="Account">Jenis Transaksi</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('pembayaran')?'active':''}}">
            <a href="{{route('pembayaran.index')}}" class="menu-link">
              <div data-i18n="Account">Pembayaran</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dollar"></i>
          <div data-i18n="Account Settings">Tagihan</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{Request::is('spp')?'active':''}}">
            <a href="" class="menu-link">
              <div data-i18n="Account">SPP</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('ekskul')?'active':''}}">
            <a href="" class="menu-link">
              <div data-i18n="Account">Ekskul</div>
            </a>
          </li>
          <li class="menu-item {{Request::is('cathering')?'active':''}}">
            <a href="" class="menu-link">
              <div data-i18n="Notifications">Cathering</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="index.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
          <div data-i18n="Analytics">Piutang</div>
        </a>
      </li>
      <li class="menu-item {{Request::is('laporan')?'active':''}}">
        <a href="{{route('laporan.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-report"></i>
          <div data-i18n="Analytics">Laporan</div>
        </a>
      </li>
      @endif
      @endif

      <!-- Siswa -->
      @if (Str::length(Auth::guard('user')->user()) > 0)
      @if (Auth::guard('user')->user()->role_id == 6)
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Siswa</span></li>
      <!-- Profil -->
      <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user"></i>
          <div data-i18n="Basic">Profil</div>
        </a>
      </li>
      <!-- Pembayaran -->
      <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
          <div data-i18n="Basic">Pembayaran</div>
        </a>
      </li>
      <!-- Pembayaran -->
      {{-- <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">Pembayaran</div>
        </a>
      </li> --}}
      <!-- Nilai Coming Soon -->
      {{-- <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">Konfirmasi Pembayaran</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="ui-accordion.html" class="menu-link">
              <div data-i18n="Accordion">Accordion</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-alerts.html" class="menu-link">
              <div data-i18n="Alerts">Alerts</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-badges.html" class="menu-link">
              <div data-i18n="Badges">Badges</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-buttons.html" class="menu-link">
              <div data-i18n="Buttons">Buttons</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-carousel.html" class="menu-link">
              <div data-i18n="Carousel">Carousel</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-collapse.html" class="menu-link">
              <div data-i18n="Collapse">Collapse</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-dropdowns.html" class="menu-link">
              <div data-i18n="Dropdowns">Dropdowns</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-footer.html" class="menu-link">
              <div data-i18n="Footer">Footer</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-list-groups.html" class="menu-link">
              <div data-i18n="List Groups">List groups</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-modals.html" class="menu-link">
              <div data-i18n="Modals">Modals</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-navbar.html" class="menu-link">
              <div data-i18n="Navbar">Navbar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-offcanvas.html" class="menu-link">
              <div data-i18n="Offcanvas">Offcanvas</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-pagination-breadcrumbs.html" class="menu-link">
              <div data-i18n="Pagination &amp; Breadcrumbs">Pagination &amp; Breadcrumbs</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-progress.html" class="menu-link">
              <div data-i18n="Progress">Progress</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-spinners.html" class="menu-link">
              <div data-i18n="Spinners">Spinners</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-tabs-pills.html" class="menu-link">
              <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-toasts.html" class="menu-link">
              <div data-i18n="Toasts">Toasts</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-tooltips-popovers.html" class="menu-link">
              <div data-i18n="Tooltips & Popovers">Tooltips &amp; popovers</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-typography.html" class="menu-link">
              <div data-i18n="Typography">Typography</div>
            </a>
          </li>
        </ul>
      </li> --}}
      @endif
      @endif
    </ul>
  </aside>
