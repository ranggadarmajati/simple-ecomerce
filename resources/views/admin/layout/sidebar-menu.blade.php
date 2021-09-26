     <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{ ($menu == 'dashboard') ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="{{ ($menu == 'product') ? 'active' : '' }}"><a href="{{ route('admin.product') }}"><i class="fa fa-cubes"></i> <span>Produk</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Transaksi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($menu == 'order_transaction' ? 'active' : '') }}"><a href="{{ route('admin.transaksi_order') }}">Konfirmasi Pembayaran</a></li>
            <li class="{{ ($menu == 'order_delivery' ? 'active' : '') }}"><a href="{{ route('admin.transaksi_delivery') }}">Konfirmasi Pengiriman</a></li>
          </ul>
        </li>
        <li class="{{ ($menu == 'slide') ? 'active' : '' }}"><a href="{{ route('admin.slide') }}"><i class="fa fa-image"></i> <span>Banner Slide</span></a></li>
        <li class="{{ ($menu == 'banner') ? 'active' : '' }}"><a href="{{ route('admin.banner') }}"><i class="fa fa-image"></i> <span>Banner Static</span></a></li>
        <li class="{{ ($menu == 'about') ? 'active' : '' }}"><a href="{{ route('admin.about') }}"><i class="fa fa-address-card"></i> <span>Tentang</span></a></li>
        <li class="{{ ($menu == 'contact') ? 'active' : '' }}"><a href="{{ route('admin.contact') }}"><i class="fa fa-id-card"></i> <span>Kontak</span></a></li>
        <li class="{{ ($menu == 'baccount') ? 'active' : '' }}"><a href="{{ route('admin.bank-account') }}"><i class="fa fa-credit-card"></i> <span>Akun Bank</span></a></li>
      </ul>