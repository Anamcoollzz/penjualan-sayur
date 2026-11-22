<!-- Top Stats Tiles -->
<div class="row tile_count mb-3">
  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
    <span class="count_top"><i class="fa fa-shopping-bag green"></i> Total Omset Penjualan</span>
    <div class="count green">Rp <?php echo number_format($stats['total_sales'], 0, ',', '.'); ?></div>
    <span class="count_bottom"><i class="green"><i class="fa fa-check-circle"></i> <?php echo $stats['count_orders']; ?></i> Pesanan (Sales Order)</span>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
    <span class="count_top"><i class="fa fa-truck blue"></i> Total Pembelian (PO)</span>
    <div class="count blue">Rp <?php echo number_format($stats['total_purchases'], 0, ',', '.'); ?></div>
    <span class="count_bottom"><i class="blue"><i class="fa fa-shopping-cart"></i> <?php echo $stats['count_purchases']; ?></i> Purchase Orders</span>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
    <span class="count_top"><i class="fa fa-cubes purple"></i> Master Item / Produk</span>
    <div class="count purple"><?php echo $stats['count_products']; ?></div>
    <span class="count_bottom"><i class="purple"><i class="fa fa-tags"></i> Aktif</i> di Katalog</span>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
    <span class="count_top"><i class="fa fa-users red"></i> Mitra & Pengiriman</span>
    <div class="count aero"><?php echo ($stats['count_customers'] + $stats['count_suppliers']); ?></div>
    <span class="count_bottom"><i class="green"><?php echo $stats['count_customers']; ?></i> Customer | <i class="blue"><?php echo $stats['count_suppliers']; ?></i> Supplier</span>
  </div>
</div>
<!-- /Top Stats Tiles -->

<!-- Quick Actions -->
<div class="row mb-3" style="margin-bottom: 20px;">
  <div class="col-md-12">
    <div class="x_panel" style="background: #f8fafc; border-left: 4px solid #1abb9c;">
      <div class="x_content" style="padding: 10px;">
        <span style="font-weight: 600; margin-right: 15px;"><i class="fa fa-bolt"></i> Aksi Cepat:</span>
        <a href="<?php echo base_url('order/create'); ?>" class="btn btn-sm btn-success" style="margin-bottom: 0;">
          <i class="fa fa-plus-circle"></i> Buat Sales Order (SO)
        </a>
        <a href="<?php echo base_url('purchase_order/create'); ?>" class="btn btn-sm btn-primary" style="margin-bottom: 0;">
          <i class="fa fa-cart-plus"></i> Buat Purchase Order (PO)
        </a>
        <a href="<?php echo base_url('m_product/create'); ?>" class="btn btn-sm btn-info" style="margin-bottom: 0;">
          <i class="fa fa-cube"></i> Tambah Item Baru
        </a>
        <a href="<?php echo base_url('m_customer/create'); ?>" class="btn btn-sm btn-default" style="margin-bottom: 0;">
          <i class="fa fa-user-plus"></i> Tambah Customer
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row">
  <!-- Monthly Trend Chart -->
  <div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-line-chart"></i> Ringkasan Keuangan Penjualan & Pembelian</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <canvas id="financeTrendChart" height="130"></canvas>
      </div>
    </div>
  </div>

  <!-- Category & Status Doughnut -->
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-pie-chart"></i> Kategori Produk</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="text-align: center; margin-bottom: 15px;">
          <canvas id="categoryChart" height="140"></canvas>
        </div>
        <table class="table table-bordered table-striped" style="margin-top: 10px;">
          <thead>
            <tr>
              <th>Kategori</th>
              <th style="text-align: right;">Jumlah Item</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($categories)): ?>
              <?php foreach ($categories as $cat): ?>
                <tr>
                  <td><i class="fa fa-circle" style="color: #26B99A; margin-right: 5px;"></i> <?php echo $cat['category']; ?></td>
                  <td style="text-align: right;"><strong><?php echo $cat['total']; ?></strong></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="2" class="text-center">Belum ada data</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Recent Transactions Tables -->
<div class="row">
  <!-- Recent Sales Orders -->
  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-shopping-cart"></i> Pesanan Penjualan Terbaru (SO)</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo base_url('order'); ?>" class="btn btn-xs btn-default"><i class="fa fa-list"></i> Lihat Semua</a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th>No SO</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recent_orders)): ?>
                <?php foreach ($recent_orders as $ord): ?>
                  <tr>
                    <td><strong><?php echo $ord['to_no']; ?></strong></td>
                    <td><?php echo $ord['mc_name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($ord['to_date'])); ?></td>
                    <td>Rp <?php echo number_format($ord['to_total'], 0, ',', '.'); ?></td>
                    <td>
                      <?php if ($ord['to_status'] == 'CLOSED'): ?>
                        <span class="label label-success">CLOSED</span>
                      <?php else: ?>
                        <span class="label label-warning"><?php echo $ord['to_status']; ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">Belum ada data pesanan penjualan</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Purchase Orders -->
  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-truck"></i> Purchase Order Terbaru (PO)</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo base_url('purchase_order'); ?>" class="btn btn-xs btn-default"><i class="fa fa-list"></i> Lihat Semua</a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th>No PO</th>
                <th>Supplier</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recent_purchases)): ?>
                <?php foreach ($recent_purchases as $po): ?>
                  <tr>
                    <td><strong><?php echo $po['tp_no']; ?></strong></td>
                    <td><?php echo $po['ms_name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($po['tp_date'])); ?></td>
                    <td>Rp <?php echo number_format($po['tp_total'], 0, ',', '.'); ?></td>
                    <td>
                      <?php if ($po['tp_status'] == 'CLOSED'): ?>
                        <span class="label label-success">CLOSED</span>
                      <?php else: ?>
                        <span class="label label-primary"><?php echo $po['tp_status']; ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">Belum ada data purchase order</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>