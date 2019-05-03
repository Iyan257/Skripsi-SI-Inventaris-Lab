<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">
		
    <div class="sidebar-header">
        <div class="sidebar-title">
            <span style="color:white"> Navigation</span>
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <?php if($this->ion_auth->in_group('kalab')) : ?>
                        <li class="<?= $this->uri->segment(2)==='home'? 'nav-active':''?>">
                            <a href="<?= base_url('kalab/home')?>">
                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-parent <?= $this->uri->segment(2)==='aset'? 'nav-active':''?>">
                            <a>
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Aset</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="<?= base_url('kalab/aset')?>">
                                        <span>Semua Aset</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('kalab/aset?pembelian=ya')?>">
                                        <span>Aset Baru</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="<?= $this->uri->segment(1)==='stok'? 'nav-active':''?>">
                            <a href="<?= base_url('stok')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Stok</span>
                            </a>
                        </li>-->
                        <li class="<?= $this->uri->segment(1)==='mutasi'? 'nav-active':''?>">
                            <a href="<?= base_url('mutasi')?>">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span>Mutasi</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='perbaikan'? 'nav-active':''?>">
                            <a href="<?= base_url('perbaikan')?>">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span>Perbaikan</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(2)==='rka'? 'nav-active':''?>">
                            <a href="<?= base_url('kalab/rka')?>">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span>Rencana Kerja Anggaran</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='barcode'? 'nav-active':''?>">
                            <a href="<?= base_url('barcode')?>">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <span>Create Barcode</span>
                            </a>
                        </li>
                        <li class="nav-parent <?= $this->uri->segment(1)==='laporan'? 'nav-active':''?>">
                            <a>
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="<?= base_url('laporan/stock_opname')?>">
                                        Stock Opname
                                    </a>
                                </li>
                                <li>
                                    <a  target="_blank" href="<?= base_url('laporan/kerusakan')?>">
                                        Kerusakan Aset
                                    </a>
                                </li>
                                <li>
                                    <a  target="_blank" href="<?= base_url('laporan/aset_BTI')?>">
                                        Aset di BTI
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='ruangan'? 'nav-active':''?>">
                            <a href="<?= base_url('ruangan')?>">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                <span>Ruangan</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='kategori'? 'nav-active':''?>">
                            <a href="<?= base_url('kategori')?>">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span>Kategori Aset</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='kategori_khusus'? 'nav-active':''?>">
                            <a href="<?= base_url('kategori_khusus')?>">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span>Kategori Khusus</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='spesifikasi'? 'nav-active':''?>">
                            <a href="<?= base_url('spesifikasi')?>">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span>Spesifikasi Elektronik</span>
                            </a>
                        </li>
                        
                    <?php elseif($this->ion_auth->in_group('input_admin')):?>
                        <li class="<?= $this->uri->segment(1)==='home'? 'nav-active':''?>">
                            <a href="<?= base_url('home')?>">
                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-parent <?= $this->uri->segment(1)==='data_master'? 'nav-active':''?>">
                            <a>
                                <i class="fa fa fa-database" aria-hidden="true"></i>
                                <span>Data Master</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?= $this->uri->segment(1)==='ruangan'? 'nav-active':''?>">
                                    <a href="<?= base_url('ruangan')?>">
                                        <span>Ruangan</span>
                                    </a>
                                </li>
                                <li class="<?= $this->uri->segment(1)==='kategori'? 'nav-active':''?>">
                                    <a href="<?= base_url('kategori')?>">
                                        <span>Kategori Aset</span>
                                    </a>
                                </li>
                                <li class="<?= $this->uri->segment(1)==='kategori_khusus'? 'nav-active':''?>">
                                    <a href="<?= base_url('kategori_khusus')?>">
                                        <span>Kategori Khusus</span>
                                    </a>
                                </li>
                                <li class="<?= $this->uri->segment(1)==='spesifikasi'? 'nav-active':''?>">
                                    <a href="<?= base_url('spesifikasi')?>">
                                        <span>Spesifikasi Elektronik</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-parent <?= $this->uri->segment(2)==='aset'? 'nav-active':''?>">
                            <a>
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Aset</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="<?= base_url('admin/aset')?>">
                                        <span>Semua Aset</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/aset?pembelian=ya')?>">
                                        <span>Aset Baru</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='mutasi'? 'nav-active':''?>">
                            <a href="<?= base_url('mutasi')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Mutasi</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='perbaikan'? 'nav-active':''?>">
                            <a href="<?= base_url('perbaikan')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Perbaikan</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='barcode'? 'nav-active':''?>">
                            <a href="<?= base_url('barcode')?>">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <span>Create Barcode</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='permintaan'? 'nav-active':''?>">
                            <a href="<?= base_url('permintaan')?>">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <span>Permintaan</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="<?= $this->uri->segment(1)==='home'? 'nav-active':''?>">
                            <a href="<?= base_url('home')?>">
                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="<?= $this->uri->segment(1)==='aset'? 'nav-active':''?>">
                            <a href="<?= base_url('aset')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Aset</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='mutasi'? 'nav-active':''?>">
                            <a href="<?= base_url('mutasi')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Mutasi</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='perbaikan'? 'nav-active':''?>">
                            <a href="<?= base_url('perbaikan')?>">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Perbaikan</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='barcode'? 'nav-active':''?>">
                            <a href="<?= base_url('barcode')?>">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <span>Create Barcode</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(1)==='permintaan'? 'nav-active':''?>">
                            <a href="<?= base_url('permintaan')?>">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <span>Permintaan</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <hr class="separator" />
        </div>
    </div>
</aside>
<!-- end: sidebar -->